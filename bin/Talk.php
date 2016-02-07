<?php

/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 15:10
 */
class Talk
{
    /**
     * Talk constructor.
     *
     * Does nothing for now but here just in case
     */
    public function __construct()
    {

    }

    /**
     * Statically accessible function to ask a question
     * and return the user's input
     *
     * @param $question
     * @param string $type to cast response to
     * @return string
     */
    public static function ask($question,$type = 'string')
    {
        // Ask the question
        echo PHP_EOL.$question.PHP_EOL;

        // Capture the response
        $stdin = fopen('php://stdin', 'r');
        $response = fgets($stdin);

        // Return it in the specified format
        settype($response,$type);
        return $response;
    }

    /**
     * Static function to print out a statement
     *
     * @param $statement
     * @param int $linefeed
     */
    public static function say($statement,$linefeed = 1)
    {
        // Say stuff, echoing the end of line feed
        // a number of times after
        echo PHP_EOL.$statement.str_repeat(PHP_EOL,$linefeed);
    }
}