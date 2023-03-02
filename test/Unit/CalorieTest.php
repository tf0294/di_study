<?php

namespace test\Unit;

require_once 'Libs/Pfc.php';
require_once 'Libs/Food.php';
require_once 'Libs/Calorie.php';

use PHPUnit\Framework\TestCase;
use Libs\Pfc;
use Libs\Calorie;
use Libs\FoodInterface;

/**
 * test calorie
 *
 * 配列で渡された値が足し算で計算され、結果が正しいことを確認しています
 * マイナスや小数点なども正しく計算されることを確認しています
 * dataProviderで整数や小数点などのパターンデータを作成し、それぞれが正しく計算されることを確認しています
 * dataProviderを使用することでどのデータでエラーになったかもわかるようにしています
 */
class CalorieTest extends TestCase
{
    /**
     * test getTotal
     * カロリーの計算のテスト
     *
     * @test
     * @dataProvider provideTestData
     * @param array $foodArray
     * @param int|float $total
     */
    public function testGetTotal(array $foodArray, int|float $total): void
    {

        $this->assertSame(Calorie::getTotal($foodArray), $total);
    }

    /**
     * provide test data
     * 計算する用の配列データ
     *
     * @return array
     */
    public function provideTestData()
    {
        return [
            [[1, 1, 1], 3], // 三大栄養素を想定
            [[1, 2, 3, 4, 5, 6], 21], // 配列の要素が多い場合
            [[1.5, 2, 3.5, 4], 11.0], // 小数点を含む場合
            [[-1, 3, 2.5, 9, 0, 3.3333], 16.8333], // マイナスや小数点を含む場合
            [[5], 5], // 配列の要素が1つの場合
        ];
    }

    /**
     * test getTotal with error
     * 異常系のテスト
     *
     * 空の配列の場合、falseが返されることを確認する
     *
     * @test
     */
    public function testGetTotalWithError(): void
    {
        // 空の配列を設定
        $foodArray = [];

        // falseが返ることを確認する
        $this->assertFalse(Calorie::getTotal($foodArray));
    }
}
