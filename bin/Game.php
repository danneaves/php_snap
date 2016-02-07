<?php

/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 14:30
 */
abstract class Game
{
    /**
     * @var Deck
     */
    protected $deck;

    /**
     * @var array holding the player objects
     */
    protected $players = [];

    /**
     * @var Player The current player
     */
    protected $currentPlayer;

    /**
     * Game constructor.
     *
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Add a player to the game
     *
     * @param Player $player
     */
    private function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     * Adds players from an array of names
     *
     * @param array $players
     */
    public function addPlayers(array $players)
    {
        foreach( $players as $player )
        {
            $player = new Player( trim($player) );
            $this->addPlayer( $player );
        }
    }

    /**
     * Deals cards to players based on hand size,
     * will deal entire deck if handSize is 0. Has scope for
     * dealing different sized hands as required
     *
     * @param int $handSize
     */
    protected function deal($handSize = 0)
    {
        Talk::say('Dealing...');

        if($handSize == 0)
        {
            // If handSize is 0 then we'll deal all the cards to all players
            $counter = floor($this->deck->undealtCount() / count($this->players));
        }
        else if($this->deck->undealtCount() >= (count($this->players) * $handSize))
        {
            // Else if theres enough cards we'll deal the appropriate handSize
            $counter = $handSize;
        }
        else
        {
            // But if theres not enough cards we'll exit
            $counter = 0;
        }

        // If we've got players
        if(!empty($this->players))
        {
            // And the counter allows it
            while($counter > 0)
            {
                // Deal a card to each player
                foreach ($this->players as $player)
                {
                    $player->takeCard( $this->deck->deal() );
                }

                // Decrement the counter
                $counter--;
            }
        }
    }
}