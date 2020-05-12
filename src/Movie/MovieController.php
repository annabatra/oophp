<?php

namespace Chbl\Movie;

use Anax\Commons\AppInjectableInterface;

use Anax\Commons\AppInjectableTrait;

class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;

    // index that redirect to show-all
    public function indexAction() : string
    {
        return $this->app->response->redirect("movie/show-all");
    }

    // Search and shows all movies currently in the database
    public function showAllAction()
    {
        $title = "Filmer | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";

        $data = [
            "resultset" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("movie/show-all", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // Search for title or word in title from userinput
    public function searchTitleAction()
    {
        $title = "Sök titel | oophp";

        $this->app->db->connect();

        $movieTitle = $this->app->request->getGet("doSearch");

        if ($movieTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $res = $this->app->db->executeFetchAll($sql, ["%$movieTitle%"]);
        }

        $data = [
            "resultset" => $res ?? null
        ];

        $this->app->page->add("movie/search-title", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    //Search depending on start and end year from user
    public function searchYearAction()
    {
        $title = "Sök år | oophp";

        $this->app->db->connect();

        $yearStart = $this->app->request->getGet("yearStart");
        $yearEnd = $this->app->request->getGet("yearEnd");

        if ($yearStart && $yearEnd) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $res = $this->app->db->executeFetchAll($sql, [$yearStart, $yearEnd]);
        } elseif ($yearStart) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $res = $this->app->db->executeFetchAll($sql, [$yearStart]);
        } elseif ($yearEnd) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $res = $this->app->db->executeFetchAll($sql, [$yearEnd]);
        }

        $data = [
            "resultset" => $res ?? null
        ];

        $this->app->page->add("movie/search-year", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    // route to select a movie to edit or delete
    public function movieSelectActionGet() : object
    {
        $title = "Databas film | oophp";

        $this->app->db->connect();
        $sql = "SELECT id, title FROM movie;";

        $data = [
            "movies" => $this->app->db->executeFetchAll($sql)
        ];

        $this->app->page->add("movie/movie-select", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Adds a movie with inputdetails from user
     */
    public function addMovieAction()
    {
        $title = "Lägg till film | oophp";

        $this->app->page->add("movie/movie-add");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * edits a movie, route
     */
    public function editMovieAction()
    {
        $title = "Edita film | oophp";

        $this->app->db->connect();
        $movieId = $this->app->request->getPost("movieId");

        if ($movieId) {
            $sql = "SELECT * FROM movie WHERE id LIKE ?;";
            $res = $this->app->db->executeFetchAll($sql, [$movieId]);
        }

        $data = [
            "movie" => $res ?? null
        ];

        $this->app->page->add("movie/movie-edit", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * save the changes from userinput
     */
    public function saveChangesAction()
    {
        $this->app->db->connect();
        $id = $this->app->request->getPost("movieId");
        $title = $this->app->request->getPost("movieTitle");
        $year = $this->app->request->getPost("movieYear");
        $img = $this->app->request->getPost("movieImage");
        $doSave = $this->app->request->getPost("doSave");

        if ($doSave) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$title, $year, $img, $id]);
        }
        return $this->app->response->redirect("movie/show-all");
    }

    /**
     * adds a new movie to the database from userinput
     */
    public function saveNewMovieAction()
    {
        $this->app->db->connect();
        $title = $this->app->request->getGet("title");
        $year = $this->app->request->getGet("year");
        $img = $this->app->request->getGet("img");
        $doAdd = $this->app->request->getGet("doAdd");

        if ($doAdd) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->execute($sql, [$title, $year, $img]);
        }
        return $this->app->response->redirect("movie/show-all");
    }

    /**
     * delete chosen movie from database depending on userinput
     */
    public function deleteMovieAction()
    {
        $this->app->db->connect();
        $id = $this->app->request->getPost("movieId");
        $doDelete = $this->app->request->getPost("doDelete");

        if ($doDelete) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$id]);
        }
        return $this->app->response->redirect("movie/show-all");
    }
}
