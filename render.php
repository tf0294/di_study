<?php

require_once 'Libs/Food.php';
require_once 'Libs/Pfc.php';
require_once 'Libs/WhiteRice.php';
require_once 'Libs/Natto.php';
require_once 'Libs/Calorie.php';

use Libs\Pfc;
use Libs\WhiteRice;
use Libs\Natto;
use Libs\Calorie;

/**
 * 納豆ご飯の総カロリーを算出
 */

try {
    // 白米の三大栄養素からカロリーを計算する
    $whiteRice = (new Pfc(new WhiteRice()))
            ->calcCalorie();

    // 納豆の三大栄養素からカロリーを計算する
    $natto = (new Pfc(new Natto()))
            ->calcCalorie();

    // 白米と納豆のそれぞれのカロリーを配列にする
    $nattoRice = [
        $whiteRice,
        $natto
    ];

    // 納豆ご飯のカロリーを求める
    $total = Calorie::getTotal($nattoRice);

    if (!$total) {
        throw new Exception('calorie calc failed.');
    }

    print $total;
} catch (Exception $e) {
    print($e);
}
