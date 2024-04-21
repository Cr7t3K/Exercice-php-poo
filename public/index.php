<?php

require_once __DIR__ . '/../src/Character.php';

$godzilla = new Character();
$godzilla->name = 'Godzilla';
$godzilla->strength = 100;
$godzilla->intelligence = 50;


$kong = new Character();
$kong->name = 'King Kong';
$kong->strength = 70;
$kong->intelligence = 80;

var_dump($godzilla, $kong);

$godzilla->attack($kong);
$godzilla->attack($kong);
$kong->heal();

$godzilla->attack($kong);
$godzilla->attack($kong);
$godzilla->attack($kong);

$kong->heal();

