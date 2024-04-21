<?php

class Character {


    private $name;
    private $strength;
    private $intelligence;
    private $health = 100;
    private $stamina = 100;

    public function __construct($name, $strength, $intelligence) {
        $this->setName($name);
        $this->setStrength($strength);
        $this->setIntelligence($intelligence);
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        if (strlen($name) >= 3 && strlen($name) <= 20 ) {
            $this->name = $name;
        } else {
            throw new InvalidArgumentException("The name must be between 3 and 20 characters long.");
        }
    }

    public function getHealth() {
        return $this->health;
    }

    public function setHealth($health) {
        if ($health >= 0 && $health <= 100) {
            $this->health = $health;
        } else {
            throw new InvalidArgumentException("The health must be between 0 and 100");
        }
    }

    public function getStrength() {
        return $this->strength;
    }

    public function setStrength($strength) {
        if ($strength >= 0 && $strength <= 100) {
            $this->strength = $strength;
        } else {
            throw new InvalidArgumentException("The strength must be between 0 and 100");
        }
    }

    public function getIntelligence() {
        return $this->intelligence;
    }

    public function setIntelligence($intelligence) {
        if ($intelligence >= 0 && $intelligence <= 100) {
            $this->intelligence = $intelligence;
        } else {
            throw new InvalidArgumentException("The intelligence must be between 0 and 100");
        }
    }

    public function getStamina() {
        return $this->stamina;
    }

    public function setStamina($stamina) {
        if ($stamina >= 0 && $stamina <= 100) {
            $this->stamina = $stamina;
        } else {
            throw new InvalidArgumentException("The stamina must be between 0 and 100");
        }
    }

    public function attack($target) {
        if (!$target instanceof Character) {
            throw new Exception("Target must be a Character.");
        }
        if ($this->getStamina() < 15) {
            echo "{$this->getName()} does not have enough stamina to attack.\n";
            return;
        }

        $randomFactor = rand(0, 100) / 100;
        $damage = $randomFactor * $this->getStrength();
        $this->setStamina($this->getStamina() - 15);

        $damage *= (1 - $target->defend() / 100);

        $health = $target->getHealth() - $damage;
        if ($health < 0) {
            $target->setHealth(0);
        } else {
            $target->setHealth($health);
        }

        $target->setIntelligence($target->getIntelligence() - 2);

        echo "{$this->getName()} attacks {$target->getName()} for " . round($damage, 2) . " damage. {$target->getName()} health is now {$target->getHealth()}. <br>";
    }

    public function defend() {
        $defenseEffectiveness = 0;
        if ($this->getStamina() > 20) {
            $defenseEffectiveness = $this->getStamina() - 20;
        }

        return $defenseEffectiveness;
    }

    public function heal() {
        $baseHealAmount = 10;
        $intelligenceBonus = ($baseHealAmount * $this->getIntelligence()) / 100;
        $totalHeal = $baseHealAmount + $intelligenceBonus;

        $heal = $this->getHealth() + $totalHeal;

        if ($heal > 100) {
            $this->setHealth(100);
        } else {
            $this->setHealth($heal);
        }
        echo "{$this->getName()} heals for " . round($totalHeal, 2) . " points, total health: {$this->getHealth()}. <br>";
    }
}