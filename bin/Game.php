<?php

/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 14:30
 */
abstract class Game
{
    protected $deck;

    protected $players = [];

    protected $currentPlayer;

    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
    }

    private function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    public function addPlayers(array $players)
    {
        foreach( $players as $player )
        {
            $player = new Player( trim($player) );
            $this->addPlayer( $player );
        }
    }

    protected function deal($size = 1)
    {
        Talk::say('Dealing...');
        // If we've got players
        if(!empty($this->players))
        {
            // And theres enough cards to keep the dealing equal
            while(($this->deck->undealtCount() * $size) >= count($this->players))
            {
                // Deal to the players
                foreach ($this->players as $player)
                {
                    $player->dealCard( $this->deck->deal($size)[0] );
                }
            }
        }
    }

    private function dealTo(Player $player)
    {

    }
}