<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

require __DIR__ . "/../autoload.php";
require __DIR__ . "/../config.php";

class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    public $number;
    public $tries;




    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    /*
    public function __construct(int $number = -1, int $tries = 6)
    { }
    */


    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;

        $this->getSecretNumber();
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    /*
    public function random()
    { }
    */

    public function generateRandomNumber()
    {
        $this->number = rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    /*
    public function tries()
    { }
    */


    public function getTriesLeft()
    {
        return($this->tries);
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    /*
    public function number()
    { }
    */


    public function getSecretNumber()
    {
        if ($this->number == -1) {
            $this->generateRandomNumber();
        }

        return($this->number);
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    /*
    public function makeGuess($number)
    { }
    */

    public function makeGuess(int $guess)
    {
        //$tries = $this->getTriesLeft();
        //$number = $this->getSecretNumber();
        if ($guess < 1 || $guess > 100) {
            throw new GuessException();
        }
        if ($guess === $this->number) {
            $res = "CORRECT! You won!";
        } elseif ($guess < $this->number) {
            $res = "too low.";
            $this->tries--;
        } else {
            $res = "too high.";
            $this->tries--;
        }
        return $res;
    }
}
