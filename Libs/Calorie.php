<?php

namespace Libs;

/**
 * カロリーに関するClass
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
    public static function getTotal(array $calories)
    {
        if (is_array($calories) && empty($calories)) {
            return false;
        }

        return array_sum($calories);
    }
}
