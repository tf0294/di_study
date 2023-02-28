<?php

namespace Libs;

require_once 'Libs/Food.php';

use Libs\FoodInterface;

/**
 * 納豆の三大栄養素を管理するClass
 */
class Natto implements FoodInterface
{
    /**
     * たんぱく質
     * @var int $protein
     */
    private $protein = 16.5;
    /**
     * 脂質
     * @var int $fat
     */
    private $fat = 10.0;
    /**
     * 炭水化物
     * @var int $carbohydrate
     */
    private $carbohydrate = 12.1;

    /**
     * たんぱく質を取得する
     *
     * @return float
     */
    public function getProtein(): float
    {
        return $this->protein;
    }

    /**
     * 脂質を取得する
     *
     * @return float
     */
    public function getFat(): float
    {
        return $this->fat;
    }

    /**
     * 炭水化物を取得する
     *
     * @return float
     */
    public function getCarbohydrate(): float
    {
        return $this->carbohydrate;
    }
}
