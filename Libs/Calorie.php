<?php

namespace Libs;

/**
 * カロリーに関するClass
 */
class Calorie
{
    /**
     * getTotal
     * 総カロリーを計算する
     *
     * @param array $calories
     * @return int|bool $allCalorie
     */
    public static function getTotal(array $calories)
    {
        if (is_array($calories) && empty($calories)) {
            return false;
        }

        return array_sum($calories);
    }
}
