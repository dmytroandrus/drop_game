<?php
class Player
{
  protected $name;
  protected $coins;

  public function __construct(string $name, int $coins)
  {
    $this->name = $name;
    if ($coins <= 0) {
      throw new Exception("Количество монет игрока {$this->getName()} должно быть положительным");
    }
    $this->coins = $coins;
  }

  public function getName()
  {
    return $this->name;
  }

  public function addCoins(int $coins)
  {
    $this->coins += $coins;
    return $this;
  }

  public function minusCoins(int $coins)
  {
    if ($this->coins < $coins) {
      throw new Exception("Игрок {$this->getName()} не имеет требуемой суммы");
    }
    $this->coins -= $coins;
    return $this;
  }

  public function getCoins()
  {
    return $this->coins;
  }

  public function getNameAndCoins()
  {
    return "{$this->name}: {$this->coins}";
  }

  public function isBankrupt()
  {
    return ($this->coins == 0);
  }
}
