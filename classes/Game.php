<?php
class Game
{
  protected $player1;
  protected $player2;
  protected $flip_cnt = 0;

  public function __construct(Player $player1, Player $player2)
  {
    $this->player1 = $player1;
    $this->player2 = $player2;
  }
  // в игре участвуют 2 игрока с монетами
  // если выпадает орел, то игрок 1 забирает у игрока 2 монету, иначе наоборот
  // игра продолжается до тех пор пока один из игроков не станет банкротом
  public function play()
  {
    echo <<<DOC
    ____Новая игра____
    Шансы {$this->player1->getName()}: {$this->odds($this->player1,$this->player2)}
    Шансы {$this->player2->getName()}: {$this->odds($this->player2,$this->player1)}
    {$this->start()}{$this->end()}
    DOC;
  }
  private function flip()
  {
    ++$this->flip_cnt;
    return mt_rand(0, 1);
  }

  private function odds(Player $player1, Player $player2)
  {
    return round(($player1->getCoins() / ($player1->getCoins() + $player2->getCoins())) * 100, 1) . '%';
  }

  private function moveCoins(Player $from, Player $to, int $amount)
  {
    $from->minusCoins($amount);
    $to->addCoins($amount);
  }

  private function start()
  {
    while (true) {
      if ($this->flip()) {
        $this->moveCoins($this->player2, $this->player1, 1);
      } else {
        $this->moveCoins($this->player1, $this->player2, 1);
      }
      if ($this->player1->isBankrupt() || $this->player2->isBankrupt()) {
        break;
      }
    }
  }

  private function end()
  {
    return <<<DOC
    ____Итог____
    Количество подбрасываний: {$this->flip_cnt}
    Количество монет {$this->player1->getNameAndCoins()}
    Количество монет {$this->player2->getNameAndCoins()}
    DOC;
  }
}
