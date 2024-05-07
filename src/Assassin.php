<?php
require_once __DIR__ . '/Character.php';

class Assassin extends Character {
    private int $agility;

    public function __construct(string $name, int $strength, int $intelligence, int $agility) {
        parent::__construct($name, $strength, $intelligence);
        $this->setAgility($agility);
    }

    private function getAgility(): int {
        return $this->agility;
    }

    private function setAgility(int $agility): void {
        if ($agility >= 0 && $agility <= 100) {
            $this->agility = $agility;
        } else {
            throw new InvalidArgumentException("Agility must be between 0 and 100.");
        }
    }

    public function attack(Character $target): void {
        parent::attack($target);

        if (rand(0, 100) < $this->getAgility()) {

            $this->setAgility($this->getAgility() - 10);
            echo "{$this->getName()} performs a swift second strike!<br>";
            parent::attack($target);
        }
    }

    private function dodge(): bool {
        $dodgeChance = $this->getAgility() / 2;

        if (rand(0, 100) < $dodgeChance) {
            echo "{$this->getName()} dodges the attack!<br>";
            return true;
        }
        return false;
    }

    protected function defend(): float|int {
        $baseDefense = parent::defend();

        if ($this->dodge()) {
            return $baseDefense + 10;
        }
        return $baseDefense;
    }

    public function sneakAttack(Character $target) {
        if ($this->getStamina() < 20) {
            echo "{$this->getName()} does not have enough stamina to perform a sneak attack.<br>";
            return;
        }

        $this->setStamina($this->getStamina() - 20);

        $criticalChance = $this->getAgility() / 100;
        $damage = $this->getStrength() * (1 + $criticalChance);
        $damage *= (1 - $target->defend() / 100);
        $target->setHealth($target->getHealth() - $damage);

        echo "{$this->getName()} performs a sneak attack on {$target->getName()} for " . $damage . " damage. {$target->getName()} health is now {$target->getHealth()}.<br>";
    }
}
