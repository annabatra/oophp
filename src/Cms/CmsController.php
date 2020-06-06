<?php

namespace Chbl\Cms;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

require "function.php";


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller for the Movie Database
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CmsController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function indexAction()
    {
        return $this->app->response->redirect("cms/show-all");
    }

    public function showAllAction()
    {
        $title = "CMS | Innehåll";

        $this->app->db->connect();
        $sql = "SELECT * FROM content";

        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("cms/show-all", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function adminAction()
    {
        $title = "CMS | Admin";
        $this->app->db->connect();
        $sql = "SELECT * FROM content;";

        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("cms/admin", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function createActionGet()
    {
        $title = "CMS | Skapa";

        $this->app->page->add("cms/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function createActionPost()
    {
        $title = "CMS | Skapa";
        $this->app->db->connect();

        if (hasKeyPost("doCreate")) {
            $title = $this->app->request->getPost("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);
            $id = $this->app->db->lastInsertId();

            return $this->app->response->redirect("cms/edit?id=$id");
        }
    }


    public function resetActionGet()
    {
        $title = "CMS | Återställ";

        $this->app->page->add("cms/reset");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function pagesActionGet()
    {
        $title = "CMS | Visa sidor";
        $this->app->db->connect();
        $page = "page";

        $sql = <<<EOD
            SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
            ELSE "notPublished"
            END AS status
                FROM content
                WHERE type=?
                ;
            EOD;
        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql, [$page]),
            "title" => $title
        ];

        $this->app->page->add("cms/pages", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function pageActionGet($path)
    {
        $title = "CMS | Visa innehåll";
        $this->app->db->connect();

        $sql = <<<EOD
            SELECT
                *,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
            FROM content
            WHERE
                path = ?
                AND type = ?
                AND (deleted IS NULL OR deleted > NOW())
                AND published <= NOW()
            ;
        EOD;

        $resultset = $this->app->db->executeFetch($sql, [$path, "page"]);
        $data = [
            "content" => $resultset
        ];

        $this->app->page->add("cms/page", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function blogActionGet()
    {
        $title = "CMS | Blogg";
        $this->app->db->connect();

        $sql = <<<EOD
            SELECT
                *,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
            FROM content
            WHERE type=?
            AND (deleted IS NULL OR deleted > NOW())
            ORDER BY published DESC
            ;
        EOD;

        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);
        $data = [
            "resultset" => $resultset
        ];

        $this->app->page->add("cms/blog", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function blogPostActionGet($slug)
    {
        $title = "CMS | Blogg";
        $this->app->db->connect();

        $sql = <<<EOD
            SELECT
                *,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
            FROM content
            WHERE
                slug = ?
                AND type = ?
                AND (deleted IS NULL OR deleted > NOW())
                AND published <= NOW()
            ORDER BY published DESC
            ;
        EOD;

        $resultset = $this->app->db->executeFetch($sql, [$slug, "post"]);
        $data = [
            "content" => $resultset
        ];

        $this->app->page->add("cms/blogpost", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * CRUD METHODS
     */

    public function editActionGet()
    {
        $title = "CMS | Editera";
        $this->app->db->connect();
        $id = $this->app->request->getGet("id");
        $sql = "SELECT * FROM content WHERE id LIKE ?";

        $data = [
            "content" => $this->app->db->executeFetchAll($sql, [$id])
        ];

        $this->app->page->add("cms/edit", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editActionPost()
    {
        $title = "CMS | Editera";
        $this->app->db->connect();
        $contentId = getPost("contentId");

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId",
            ]);

            if (!$params["contentSlug"]) {
                $params["contentSlug"] = slugify($params["contentTitle"]);
            }

            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }

            if (!$params["contentFilter"]) {
                $params["contentFilter"] = "bbcode";
            }

            $currSlug = $params["contentSlug"];
            $currId = $params["contentId"];
            $slugSql = "SELECT id FROM content WHERE slug = ?;";
            $res = $this->app->db->executeFetch($slugSql, [$currSlug]);
            if ($res != null and $res->id != $currId) {
                $params["contentSlug"] = null;
            }

            $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
            $this->app->db->execute($sql, array_values($params));

            return $this->app->response->redirect("cms/edit?id=$contentId");
            return $this->app->page->render([
                "title" => $title
            ]);
        }
    }

    public function deleteActionGet()
    {
        $title = "CMS | Radera";
        $this->app->db->connect();
        $id = $this->app->request->getGet("id");

        $sql = "SELECT * FROM content WHERE id LIKE ?";

        $data = [
            "content" => $this->app->db->executeFetchAll($sql, [$id])
        ];

        $this->app->page->add("cms/delete", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function deleteActionPost()
    {
        $this->app->db->connect();

        if (hasKeyPost("doDelete")) {
            $contentId = getPost("contentId");
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$contentId]);
            return $this->app->response->redirect("cms/admin");
        }
    }
}
