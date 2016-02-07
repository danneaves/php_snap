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
     * @var object holding the last card dealt
     */
    private $lastCard;

    /**
     * the list of card suits
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
     * Deals a card off the top of the deck
     *
     * @return object|bool
     */
    public function deal()
    {
        // Return false if we've run out of cards
        if(!$this->undealtCount()) return false;

        // Clear the last card and set a shorter var for use in
        // the function
        $card =& $this->lastCard;
        $card = (object) [];

        // Shift off the beginning!
        $card = $this->dealtCards[] = array_shift($this->undealtCards);

        return $card;
    }

    /**
     * Resets the deck and shuffles the pack
     *
     * @return $this
     */
    public function reset()
    {
        // Take all the dealt cards and add them to the undealt stack
        $this->undealtCards = array_merge($this->undealtCards,$this->dealtCards);

        // Empty the dealt cards array
        $this->dealtCards = [];

        // Return the shuffled deck
        return $this->shuffle();
    }

    /**
     * Gets the count of the remaining cards
     *
     * @return int
     */
    public function undealtCount()
    {
        return count($this->undealtCards);
    }
}