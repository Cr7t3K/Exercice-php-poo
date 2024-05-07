<?php
require_once __DIR__ . '/Character.php';

class Warrior extends Character {
    private int $armor;

    public function __construct(string $name, int $strength, int $intelligence, int $armor) {
        parent::__construct($name, $strength, $intelligence);
        $this->setArmor($armor);
    }

    private function getArmor(): int {
        return $this->armor;
    }

    private function setArmor($armor): void {
        if ($armor >= 0 && $armor <= 50) {
            $this->armor = $armor;
        } else {
            throw new InvalidArgumentException("Armor must be between 0 and 50.");
        }
    }

    protected function defend(): int {
        $baseDefense = parent::defend();
        return $baseDefense + $this->getArmor();
    }

    public function powerStrike(Character $target): void {
        if ($this->getStamina() < 30) {
            echo "{$this->getName()} does not have enough stamina to perform a power strike.<br>";
            return;
        }

        $this->setStamina($this->getStamina() - 30);

        $damage = 1.3 * $this->getStrength(); // 130% de la force
        $damage *= (1 - $target->defend() / 100);
        $target->setHealth($target->getHealth() - $damage);

        echo "{$this->getName()} performs a power strike on {$target->getName()} for " . $damage . " damage. {$target->getName()} health is now {$target->getHealth()}.<br>";
    }
}
