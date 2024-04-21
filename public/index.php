<?php

require_once __DIR__ . '/../src/Character.php';

$godzilla = new Character("Godzilla", 100, 50);


$kong = new Character("King Kong", 70, 80);

$godzilla->attack($kong);
$godzilla->attack($kong);
$kong->heal();

$godzilla->attack($kong);
$godzilla->attack($kong);
$godzilla->attack($kong);

$kong->heal();