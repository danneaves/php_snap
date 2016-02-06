<?php

/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 14:08
 */
class Player
{
    /**
     * @var array of played hands
     */
    private $playedHands = [];

    /**
     * @var array complete set of cards
     */
    private $cards = [];

    /**
     * @var array the current hand of the player
     */
    private $currentHand = [];

    /**
     * @var array the last played hand
     */
    private $lastHand = [];

    /**
     * @var string default player name
     */
    private $name = 'Anonymous';

    /**
     * Player constructor.
     *
     * @param bool|string $name
     */
    public function __construct($name = false)
    {
        // Make player unique when we're
        // being lazy...
        if(!$name)
        {
            $this->name .= rand(10000,99999);
        } else {
            $this->name = $name;
        }
    }

    public function dealCards($cards)
    {
        $this->cards = array_merge($this->cards,$cards);
    }

    public function dealCard($card)
    {
        $this->cards[] = $card;
    }

    public function playHand($size = 1)
    {
        // Capture the last hand
        $this->lastHand = $this->currentHand ?: null;

        // Clear the current hand
        $this->currentHand = [];

        for($i = 0; $i < $size; $i++)
        {
            $this->currentHand[] = array_pop($this->cards);
        }
        return $this->currentHand;
    }

    public function getHand()
    {
        return $this->currentHand;
    }

    public function getName()
    {
        return $this->name;
    }

    public function cardCount()
    {
        return count($this->cards);
    }
}