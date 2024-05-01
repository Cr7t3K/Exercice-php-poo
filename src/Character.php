<?php

class Character {

    // Déclaration des propriétés privées de la classe
    private string $name;
    private int $strength;
    private int $intelligence;
    private int $health = 100;
    private int $stamina = 100;

    // Constructeur pour initialiser les objets Character avec nom, force et intelligence
    public function __construct($name, $strength, $intelligence) {
        $this->setName($name);
        $this->setStrength($strength);
        $this->setIntelligence($intelligence);
    }

    // Getter pour obtenir le nom
    public function getName(): string {
        return $this->name;
    }

    // Setter pour définir le nom, avec validation de la longueur
    public function setName(string $name): void {
        if (strlen($name) >= 3 && strlen($name) <= 20 ) {
            $this->name = $name;
        } else {
            throw new InvalidArgumentException("The name must be between 3 and 20 characters long.");
        }
    }

    // Getter pour obtenir la santé
    public function getHealth(): int {
        return $this->health;
    }

    // Setter pour définir la santé, avec validation de la valeur
    public function setHealth(int $health): void {
        if ($health >= 0 && $health <= 100) {
            $this->health = $health;
        } else {
            throw new InvalidArgumentException("The health must be between 0 and 100");
        }
    }

    // Getter pour obtenir la force
    public function getStrength(): int {
        return $this->strength;
    }

    // Setter pour définir la force, avec validation de la valeur
    public function setStrength(int $strength): void {
        if ($strength >= 0 && $strength <= 100) {
            $this->strength = $strength;
        } else {
            throw new InvalidArgumentException("The strength must be between 0 and 100");
        }
    }

    // Getter pour obtenir l'intelligence
    public function getIntelligence(): int {
        return $this->intelligence;
    }

    // Setter pour définir l'intelligence, avec validation de la valeur
    public function setIntelligence(int $intelligence): void {
        if ($intelligence >= 0 && $intelligence <= 100) {
            $this->intelligence = $intelligence;
        } else {
            throw new InvalidArgumentException("The intelligence must be between 0 and 100");
        }
    }

    // Getter pour obtenir l'endurance
    public function getStamina(): int {
        return $this->stamina;
    }

    // Setter pour définir l'endurance, avec validation de la valeur
    public function setStamina(int $stamina): void {
        if ($stamina >= 0 && $stamina <= 100) {
            $this->stamina = $stamina;
        } else {
            throw new InvalidArgumentException("The stamina must be between 0 and 100");
        }
    }

    // Méthode pour attaquer un autre personnage
    public function attack(Character $target): void {

        // Vérifie si le personnage a assez d'endurance pour attaquer
        if ($this->getStamina() < 15) {
            echo "{$this->getName()} does not have enough stamina to attack.\n";
            return;
        }

        // Génération aléatoire entre 0 et 1 pour le calcul des dégâts
        $randomFactor = rand(0, 100) / 100;
        // Calcul des dégâts en utilisant la force du personnage et le facteur aléatoire
        $damage = $randomFactor * $this->getStrength();
        // Réduction de l'endurance de 15 points du personnage après l'attaque
        $this->setStamina($this->getStamina() - 15);

        // Application de la défense de la cible pour réduire les dégâts infligés
        $damage *= (1 - $target->defend() / 100);

        // Calcul de la nouvelle santé de la cible après l'attaque
        $health = $target->getHealth() - $damage;
        if ($health < 0) {
            $target->setHealth(0);
        } else {
            $target->setHealth($health);
        }

        // Réduction de l'intelligence de la cible suite à l'attaque
        $target->setIntelligence($target->getIntelligence() - 3);

        echo "{$this->getName()} attacks {$target->getName()} for " . $damage . " damage. {$target->getName()} health is now {$target->getHealth()}. <br>";
    }

    // Méthode pour défendre contre une attaque
    public function defend(): int|float {
        $defenseEffectiveness = 0;
        if ($this->getStamina() > 20) {
            $defenseEffectiveness = $this->getStamina() - 20;
        }

        return $defenseEffectiveness;
    }

    // Méthode pour se soigner
    public function heal(): void {
        $baseHealAmount = 10; // Montant de base de la guérison
        $intelligenceBonus = ($baseHealAmount * $this->getIntelligence()) / 100; // Bonus de guérison basé sur l'intelligence
        $totalHeal = $baseHealAmount + $intelligenceBonus; // Calcul du total de points de vie récupérés (points de base + bonus)

        // Enregistre la nouvelle valeur de santé après guérison dans une variable.
        $heal = $this->getHealth() + $totalHeal;

        // Assure que la santé ne dépasse pas 100. Si elle ne dépasse pas 100, la guérison est appliquée normalement, sinon, la santé est limitée à 100 maximum.
        if ($heal > 100) {
            $this->setHealth(100);
        } else {
            $this->setHealth($heal);
        }
        echo "{$this->getName()} heals for " . round($totalHeal, 2) . " points, total health: {$this->getHealth()}. <br>";
    }
}