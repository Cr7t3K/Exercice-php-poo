<?php

// Include le fichier Character.php pour pouvoir utiliser la classe
require_once __DIR__ . '/../src/Character.php';

// Crée deux nouveaux personnages avec des caractéristiques différentes.
$godzilla = new Character("Godzilla", 100, 50);
$kong = new Character("King Kong", 70, 80);

// Godzilla attaque King Kong
$godzilla->attack($kong);
$godzilla->attack($kong);

// King Kong se soigne après avoir reçu deux attaques
$kong->heal();

// Godzilla attaque King Kong
$godzilla->attack($kong);
$godzilla->attack($kong);
$godzilla->attack($kong);

// King Kong se soigne après avoir reçu trois attaques
$kong->heal();