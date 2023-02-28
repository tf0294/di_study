<?php

namespace Libs;

use Libs\Calorie;

/**
 * 三大栄養素から食品のカロリーを計算するClass
 */
class Pfc
{
    /**
     * @var FoodInterface
     */
    private $food;

    /**
     * construct
     *
     * @param FoodInterface $food
     */
    public function __construct(FoodInterface $food)
    {
        $this->food = $food;
    }

    /**
     * タンパク質のカロリーを求める
     *
     * @return int
     */
    protected function calcProteinCalorie(): int
    {
        $protein = $this->food->getProtein() * 4;
        return (int) $protein;
    }

    /**
     * 脂質のカロリーを求める
     *
     * @return int
     */
    protected function calcFatCalorie(): int
    {
        $fat =  $this->food->getFat() * 9;
        return (int) $fat;
    }

    /**
     * 炭水化物のカロリーを求める
     *
     * @return int
     */
    protected function calcCarbohydrateCalorie(): int
    {
        $cabohydrate = $this->food->getCarbohydrate() * 4;
        return (int) $cabohydrate;
    }

    /**
     * 三大栄養素から食品の総カロリーを計算する
     *
     * @return int $calorie
     */
    public function calcCalorie(): int
    {
        $proteinCalorie = $this->calcProteinCalorie();
        $fatCalorie = $this->calcFatCalorie();
        $carbohydrateCalorie = $this->calcCarbohydrateCalorie();

        $nutrients = [
            $proteinCalorie,
            $fatCalorie,
            $carbohydrateCalorie
        ];

        $calorie = Calorie::getTotal($nutrients);

        return (int) $calorie;
    }
}
