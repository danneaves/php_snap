<?php

/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 14:37
 */
class Snap extends Game
{
    /**
     * @var int Holds the pause in ms between hands
     */
    private $interval = 1;

    /**
     * @var object last card
     */
    private $lastCard = null;

    /**
     * @var array holding the current stack of cards
     */
    private $stack = [];

    /**
     * @var bool Is the game over?
     */
    private $finished = false;

    /**
     * Snap constructor.
     *
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        parent::__construct($deck);

        $this->setup();
        $this->deal();
        $this->play();
    }

    /**
     * Does all the interaction with the screen
     */
    private function setup()
    {
        // Clear the screen
        system('clear');

        // Welcome people, because it's polite
        Talk::say(
          '---------------------------------------'.PHP_EOL.
          'Welcome to Snap'.PHP_EOL.
          '---------------------------------------'
        );

        // Invite your players to enter their names
        $players = Talk::ask('Enter the player names separated by commas;');

        // Get those son-bitches added to the game!
        $this->addPlayers( explode(',',$players) );
    }

    /**
     * The main logic for the game
     *
     * TODO: Split into logical functions
     */
    private function play()
    {
        // Until the game is over...
        while(!$this->finished) {
            // Let the players play!
            foreach ($this->players as $player) {
                // The player plays a hand...
                $hand = $player->playHand();

                // Set the last card
                $this->lastCard = end($this->stack);

                // Push the hand onto the stack
                foreach ($hand as $card) {
                    array_push($this->stack, $card);
                    Talk::say($player->getName() . ": " . $card->card);
                }

                // If there's a last card and the player's hand matches it...
                if (!empty($this->lastCard) and end($hand)->rank == $this->lastCard->rank) {
                    // Give the player the stack and clear the last card
                    $player->takeCards($this->stack);
                    $this->stack = $this->lastCard = [];
                    // Tell the player their a loser!
                    Talk::say("Snap! " . $player->getName() . " takes the stack!");
                    $this->playerSummary();
                }

                // If a player runs out of cards they win!
                if ($player->cardCount() == 0) {
                    Talk::say("Winner! " . $player->getName() . " is out of cards!");
                    $this->finished = true;
                    break;
                }
            }
            // Make the game readable by having a little interval!
            sleep($this->interval);
        }
    }

    /**
     * Echos out a summary of current player card counts
     */
    private function playerSummary()
    {
        foreach($this->players as $player)
        {
            Talk::say($player->getName() . " now has " . $player->cardCount() . " cards",0);
        }
        Talk::say('',0);
    }
}