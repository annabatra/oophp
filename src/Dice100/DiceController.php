<?php

namespace Chbl\Dice100;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "INDEX!!";
    }

    /**
     * This is the debug action
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!!";
    }

    /**
     * This is the init action
     *
     * @return string
     */
    public function initAction() : object
    {
        // init the session for the game.
        session_destroy();
        $this->app->session->start();
        $this->app->session->set("dice", new DiceGame());

        return $this->app->response->redirect("dice1/play");
    }


    /**
     * This is the playActionGet action
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Pig Dice game";

        $data = [
            "diceGame" => $this->app->session->get("dice")
        ];

        $this->app->page->add("dice1/play", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the playActionpost action
     *
     */

    public function playActionPost() : object
    {
        $diceGame = $this->app->session->get("dice");

        if ($this->app->request->getPost("roll")) {
            $diceGame->playerRoll();
        } elseif ($this->app->request->getPost("endTurn")) {
            $diceGame->nextTurn(1);
        } elseif ($this->app->request->getPost("botRoll")) {
            $diceGame->botRoll();
        }

        return $this->app->response->redirect("dice1/play");
    }
}
