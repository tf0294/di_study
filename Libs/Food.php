<?php

namespace Libs;

/**
 * 食品interface
 */
interface FoodInterface
{
    /**
     * たんぱく質を取得する
     *
     * @return float
     */
    public function getProtein(): float;

    /**
     * 脂質を取得する
     *
     * @return float
     */
    public function getFat(): float;

    /**
     * 炭水化物を取得する
     *
     * @return float
     */
    public function getCarbohydrate(): float;
}
