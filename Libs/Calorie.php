<?php

namespace Libs;

/**
 * 食品毎のカロリーから総カロリーを計算する
 */
class Calorie
{
    /**
     * getTotal
     * 総カロリーを計算して返す
     *
     * @param array $calories
     * @return int|false $allCalorie
     */
    public function getTotal(array $calories)
    {
        if (is_array($calories) && empty($calories)) {
            return false;
        }

        return array_sum($calories);
    }
}
