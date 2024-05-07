<?php

require_once __DIR__ . '/../src/Assassin.php';
require_once __DIR__ . '/../src/Warrior.php';
require_once __DIR__ . '/../src/Mage.php';

$jack = new Warrior("Jack", 80, 40, 30);
$robin = new Assassin("Robin", 60, 30, 50);
$tom = new Mage("Tom", 40, 80, 80);

$jack->attack($tom);
$jack->attack($robin);

$robin->attack($tom);
$robin->attack($jack);

$jack->powerStrike($robin);


$robin->sneakAttack($jack);

$tom->castSpell($jack);
$tom->heal();
$tom->heal();
$tom->heal();