<?php

namespace test\Unit;

require_once 'Libs/Pfc.php';
require_once 'Libs/Food.php';

use PHPUnit\Framework\TestCase;
use Libs\Pfc;
use Libs\FoodInterface;

/**
 * pfcTest
 * 三大栄養素から食品のカロリーを計算するClassのテスト
 *
 * Classの単体テストがしやすいようにDIで依存関係を外部から注入するようにして、
 * モックを使ってたんぱく質、脂質、炭水化物の値を任意に設定できるようにしました。
 * DIはコンストラクター・インジェクションにしています。
 *
 */
class PfcTest extends TestCase
{
    protected function setUp(): void
    {
        $this->foodMock = $this->createMock(FoodInterface::class);
    }

    /**
     * test calcProteinCalorie
     * タンパク質のカロリーを求めるテスト
     */
    public function testCalcProteinCalorie(): void
    {
        /**
         * 食品Mockを作成する
         * タンパク質の戻り値は計算がわかりやすいよう1にする
         */
        $this->foodMock->expects($this->once())
                ->method('getProtein')
                ->will($this->returnValue(1));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // ReflectionClassを使ってprotectedメソッドのcalcProteinCalorieにアクセスする
        $reflection = new \ReflectionClass($pfc);
        $property = $reflection->getMethod('calcProteinCalorie');
        $property->setAccessible(true);

        // タンパク質のカロリーが1*4(1(g)=4(kcal))で計算かつint型であるかを確認する
        $this->assertSame($property->invoke($pfc), 4);
    }

    /**
     * test calcFatCalorie
     * 脂質のカロリーを求めるテスト
     */
    public function testCalcFatCalorie(): void
    {
        /**
         * 食品Mockを作成する
         * 脂質の戻り値は計算の結果がわかりやすいよう1にする
         */
        $this->foodMock->expects($this->once())
                ->method('getFat')
                ->will($this->returnValue(1));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // ReflectionClassを使ってprotectedメソッドのcalcFatCalorieにアクセスする
        $reflection = new \ReflectionClass($pfc);
        $property = $reflection->getMethod('calcFatCalorie');
        $property->setAccessible(true);

        // 脂質のカロリーが1*9(1(g)=9(kcal))で計算されかつint型であるかを確認する
        $this->assertSame($property->invoke($pfc), 9);
    }

    /**
     * test calcCarbohydrateCalorie
     * 炭水化物のカロリーを求める
     */
    public function testCalcCarbohydrateCalorie(): void
    {
        /**
         * 食品Mockを作成する
         * 炭水化物の戻り値は計算がわかりやすいよう1にする
         */
        $this->foodMock->expects($this->once())
                ->method('getCarbohydrate')
                ->will($this->returnValue(1));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // ReflectionClassを使ってprotectedメソッドのcalcCarbohydrateCalorieにアクセスする
        $reflection = new \ReflectionClass($pfc);
        $property = $reflection->getMethod('calcCarbohydrateCalorie');
        $property->setAccessible(true);

        // 炭水化物のカロリーが1*9(1(g)=4(kcal))で計算されかつint型であるかを確認する
        $this->assertSame($property->invoke($pfc), 4);
    }

    /**
     * test calcCalorie
     * 三大栄養素から食品の総カロリーを計算するテスト
     */
    public function testCalcCalorie(): void
    {
        /**
         * 食品Mockを作成して、たんぱく質、脂質、炭水化物
         * をそれぞれ1に設定する
         */
        /// たんぱく質のカロリーが4になるように設定する
        $this->foodMock->expects($this->any(0))
                ->method('getProtein')
                ->will($this->returnValue(1));

        // 脂質のカロリーが9になるように設定する
        $this->foodMock->expects($this->any(1))
                ->method('getFat')
                ->will($this->returnValue(1));

        // 炭水化物のカロリーが4になるように設定する
        $this->foodMock->expects($this->any(2))
                ->method('getCarbohydrate')
                ->will($this->returnValue(1));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // たんぱく質、脂質、炭水化物のカロリーの合計が17になるように設定して、
        // 17で計算されかつint型であることを確認する
        $this->assertSame($pfc->calcCalorie($pfc), 17);
    }
}
