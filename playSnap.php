<?php
/**
 * Created by PhpStorm.
 * User: danielneaves
 * Date: 06/02/2016
 * Time: 14:48
 */

// Set up the autoloader
spl_autoload_register(function ($class_name) {
    include "bin/$class_name.php";
});

$deck = new Deck();
$snap = new Snap($deck);

