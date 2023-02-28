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

try {
    // 白米のカロリーを計算する
    $whiteRice = (new Pfc(new WhiteRice()))
            ->calcCalorie();

    // 納豆のカロリーを計算する
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
