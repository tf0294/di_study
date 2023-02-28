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
 * 複数の食品の組み合わせから総カロリーが計算されることを確認する
 * 2つの食品、食品１と食品２のそれぞれのモックを作成して、総カロリーが計算されるかを
 * テストする
 */
class CalorieTest extends TestCase
{
    protected function setUp(): void
    {
        // 食品1Mockを生成
        $this->food1Mock = $this->createMock(FoodInterface::class);

        // 食品2Mockを生成
        $this->food2Mock = $this->createMock(FoodInterface::class);
    }

    /**
     * test getTotal
     */
    public function testGetTotal(): void
    {
        /**
         * 食品1Mockを作成して、カロリーが17になるように設定する
         */
        /// たんぱく質のカロリーが4になるように設定する
        $this->food1Mock->expects($this->any(0))
                ->method('getProtein')
                ->will($this->returnValue(1));

        // 脂質のカロリーが9になるように設定する
        $this->food1Mock->expects($this->any(1))
                ->method('getFat')
                ->will($this->returnValue(1));

        // 炭水化物のカロリーが4になるように設定する
        $this->food1Mock->expects($this->any(2))
                ->method('getCarbohydrate')
                ->will($this->returnValue(1));

        // 作成した食品1Mockをコンストラクター・インジェクション
        $food1Calorie = (new Pfc($this->food1Mock))
                ->calcCalorie();

        /**
         * 食品2Mockを作成して、カロリーが17になるように設定する
         */
        /// たんぱく質のカロリーが4になるように設定する
        $this->food2Mock->expects($this->any(0))
                ->method('getProtein')
                ->will($this->returnValue(1));

        // 脂質のカロリーが9になるように設定する
        $this->food2Mock->expects($this->any(1))
                ->method('getFat')
                ->will($this->returnValue(1));

        // 炭水化物のカロリーが4になるように設定する
        $this->food2Mock->expects($this->any(2))
                ->method('getCarbohydrate')
                ->will($this->returnValue(1));

        // 作成した食品2Mockをコンストラクター・インジェクション
        $food2Calorie = (new Pfc($this->food2Mock))
                ->calcCalorie();

        // 食品1と食品2のカロリーの配列
        $nattoRice = [
            $food1Calorie,
            $food2Calorie
           ];

        // 納豆と白米のカロリーがそれぞれ17になるように設定して、
        // 34で計算されかつint型であることを確認する
        $this->assertSame(Calorie::getTotal($nattoRice), 34);
    }

    /**
     * test getTotal with error
     * 異常系のテスト
     *
     * 空の配列を設定し、Falseが返されることを確認する
     */
    public function testGetTotalWithError(): void
    {
        // 空の配列を設定
        $nattoRice = [];

        // falseが返ることを確認する
        $this->assertFalse(Calorie::getTotal($nattoRice));
    }
}
