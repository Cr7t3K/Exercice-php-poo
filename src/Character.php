<?php

class Character {
    public $name;
    public $health = 100;
    public $strength;
    public $intelligence;
    public $stamina = 100;


    public function attack($target) {
        if (!$target instanceof Character) {
            throw new Exception("Target must be a Character.");
        }
        if ($this->stamina < 15) {
            echo "{$this->name} does not have enough stamina to attack.\n";
            return;
        }

        $randomFactor = mt_rand() / mt_getrandmax();
        $damage = $randomFactor * $this->strength;
        $this->stamina -= 15;

        $damage *= (1 - $target->defend() / 100);

        $target->health -= round($damage, 2);
        $target->intelligence -= 2;

        if ($target->health < 0) {
            $target->health = 0;
        }
        echo "{$this->name} attacks {$target->name} for " . round($damage, 2) . " damage. {$target->name} health is now {$target->health}. <br>";
    }

    public function defend() {
        $defenseEffectiveness = 0;
        if ($this->stamina > 20) {
            $defenseEffectiveness = $this->stamina - 20;
        }

        return $defenseEffectiveness;
    }

    public function heal() {
        $baseHealAmount = 10;
        $intelligenceBonus = ($baseHealAmount * $this->intelligence) / 100;
        $totalHeal = $baseHealAmount + $intelligenceBonus;
        $this->health += $totalHeal;

        if ($this->health > 100) {
            $this->health = 100;
        }
        echo "{$this->name} heals for " . round($totalHeal, 2) . " points, total health: {$this->health}. <br>";
    }
}