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
        // タンパク質の摂取グラムを小数第二位で四捨五入
        $protein = round($this->food->getProtein(), 1);
        $calorie = $protein * 4;

        // 算出したカロリーを整数にする
        return (int) $calorie;
    }

    /**
     * 脂質のカロリーを求める
     *
     * @return int
     */
    protected function calcFatCalorie(): int
    {
        // 脂質の摂取グラムを小数第二位で四捨五入
        $fat = round($this->food->getFat(), 1);
        $calorie = $fat * 9;

        // 算出したカロリーを整数にする
        return (int) $calorie;
    }

    /**
     * 炭水化物のカロリーを求める
     *
     * @return int
     */
    protected function calcCarbohydrateCalorie(): int
    {
        // 炭水化物の摂取グラムを小数第二位で四捨五入
        $cabohydrate = round($this->food->getCarbohydrate(), 1);
        $calorie = $cabohydrate * 4;

        // 算出したカロリーを整数にする
        return (int) $calorie;
    }

    /**
     * 三大栄養素から食品のカロリーを計算する
     *
     * @return int $calorie
     */
    public function calcCalorie(): int
    {
        // タンパク質、脂質、炭水化物のそれぞれのカロリーを求める
        $proteinCalorie = $this->calcProteinCalorie();
        $fatCalorie = $this->calcFatCalorie();
        $carbohydrateCalorie = $this->calcCarbohydrateCalorie();

        $nutrients = [
            $proteinCalorie,
            $fatCalorie,
            $carbohydrateCalorie
        ];

        // 三大栄養素で求めたカロリーから食品のカロリーを算出する
        $calorie = Calorie::getTotal($nutrients);

        return (int) $calorie;
    }
}
