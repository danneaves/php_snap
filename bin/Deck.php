<?php

/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 12:19
 */
class Deck
{
    /**
     * @var array holding the deck in it's current state
     */
    private $undealtCards = [];

    /**
     * @var array holding dealt cards
     */
    private $dealtCards = [];

    /**
     * @var array holding the last hand dealt
     */
    private $lastHand = [];

    /**
     * the abbreviated list of card suits
     */
    public static $suits = ['Clubs','Diamonds','Hearts','Spades'];

    /**
     * holds the ranks of all cards A,2,3,4..
     */
    public static $ranks = ['A',2,3,4,5,6,7,8,9,10,'J','Q','K'];

    /**
     * Deck constructor.
     *
     * Initialises a new deck of cards and shuffles it
     */
    public function __construct()
    {
        $this->buildDeck()
            ->shuffle();
    }

    /**
     * Bins the current deck state and builds a new one from scratch,
     * returns self for method chaining
     *
     * @return $this
     */
    private function buildDeck()
    {
        // Empty the card arrays
        $this->undealtCards = $this->dealtCards = [];

        // Join on the suit name and add to the undealt card array
        foreach (static::$suits as $suit)
        {
            foreach (static::$ranks as $rank)
            {
                array_push(
                    $this->undealtCards,
                    (object) [
                        'rank' => $rank,
                        'suit' => $suit,
                        'card' => "$rank $suit"
                    ]
                );
            }
        }

        // Allow method chaining by returning self
        return $this;
    }

    /**
     * Shuffles the undealt cards
     *
     * @return $this
     */
    public function shuffle()
    {
        // Use PHP's inbuilt method
        shuffle($this->undealtCards);

        // Return self for method chaining
        return $this;
    }

    /**
     * Deals a new hand off the top of the deck
     *
     * @param $size
     * @return array
     */
    public function deal($size = 1)
    {
        // Clear the last hand and set a shorter var for use in
        // the function
        $hand =& $this->lastHand;
        $hand = [];

        // Shift off the beginning!
        for( $i = 0; $i < $size; $i++)
        {
            $hand[] = $this->dealtCards[] = array_shift($this->undealtCards);
        }

        return $hand;
    }

    public function dealt()
    {
        return $this->dealtCards;
    }

    public function undealtCount()
    {
        return count($this->undealtCards);
    }
}