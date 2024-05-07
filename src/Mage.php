<?php
require_once __DIR__ . '/Character.php';

class Mage extends Character {
    private int $mana;

    public function __construct(string $name, int $strength, int $intelligence, int $mana) {
        parent::__construct($name, $strength, $intelligence);
        $this->setMana($mana);
    }

    private function setMana($mana): void {
        if ($mana >= 0 && $mana <= 100) {
            $this->mana = $mana;
        } else {
            throw new InvalidArgumentException("Mana must be between 0 and 100.");
        }
    }

    private function getMana(): int {
        return $this->mana;
    }

    public function castSpell(Character $target) {
        if ($this->getMana() < 20) {
            echo "{$this->getName()} does not have enough mana to cast a spell.<br>";
            return;
        }

        $this->setMana($this->getMana() - 20);
        $damage = 2 * $this->getIntelligence();
        $damage *= (1 - $target->defend() / 100);

        $health = $target->getHealth() - $damage;
        if ($health < 0) {
            $target->setHealth(0);
        } else {
            $target->setHealth(min(100, $health));
        }

        echo "{$this->getName()} casts a spell on {$target->getName()} for " . $damage . " damage. {$target->getName()} health is now {$target->getHealth()}.<br>";
    }

    public function heal(): void {
        $baseHealAmount = 10;
        $intelligenceBonus = ($baseHealAmount * $this->getIntelligence()) / 100;
        $manaBonus = $this->getMana() / 100;

        $totalHeal = $baseHealAmount + $intelligenceBonus * $manaBonus;

        $heal = $this->getHealth() + $totalHeal;

        if ($heal > 100) {
            $this->setHealth(100);
        } else {
            $this->setHealth($heal);
        }
        echo "{$this->getName()} casts a healing spell and heals for " . round($totalHeal, 2) . " points, total health: {$this->getHealth()}. <br>";
    }
}
