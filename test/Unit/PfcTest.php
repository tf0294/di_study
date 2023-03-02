<?php

namespace test\Unit;

require_once 'Libs/Pfc.php';
require_once 'Libs/Food.php';
require_once 'Libs/Calorie.php';

use PHPUnit\Framework\TestCase;
use Libs\Pfc;
use Libs\FoodInterface;
use Libs\Calorie;

/**
 * pfcTest
 * 三大栄養素から食品のカロリーを計算するClassのテスト
 *
 * 単体テストがしやすいようにDIで依存関係を外部から注入するようにして、
 * モックを使って食品のたんぱく質、脂質、炭水化物の値を任意に設定できるようにしました。
 * dataProviderで整数や小数点などのパターンデータを作成し、それぞれが正しく計算されることを確認しています。
 * dataProviderを使用することでどのデータでエラーになったかもわかるようにしています。
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
     *
     * @test
     * @dataProvider provideTestProteinData
     * @param int|float $gram
     * @param int $total
     */
    public function testCalcProteinCalorie(int|float $gram, int $total): void
    {
        /**
         * 食品Mockを作成し、dataProviderからグラム数を設定する
         */
        $this->foodMock->expects($this->once())
                ->method('getProtein')
                ->will($this->returnValue($gram));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // ReflectionClassを使ってprotectedメソッドのcalcProteinCalorieにアクセスする
        $reflection = new \ReflectionClass($pfc);
        $property = $reflection->getMethod('calcProteinCalorie');
        $property->setAccessible(true);

        // タンパク質のカロリーが1(g)=4(kcal)で計算され、整数であることを確認する
        $this->assertSame($property->invoke($pfc), $total);
    }

    /**
     * provide test protein data
     * テスト用のタンパク質データ
     *
     * @return array
     */
    public function provideTestProteinData()
    {
        return [
            [1, (int)4], // 整数での計算
            [1.2, (int)5], // グラム数が小数点、トータルが四捨五入される
            [1.555555, (int)6], // グラム数が小数点第二位で四捨五入される
        ];
    }

    /**
     * test calcFatCalorie
     * 脂質のカロリーを求めるテスト
     *
     * @test
     * @dataProvider provideTestFatData
     * @param int|float $gram
     * @param int $total
     */
    public function testCalcFatCalorie(int|float $gram, int $total): void
    {
        /**
         * 食品Mockを作成し、dataProviderからグラム数を設定する
         */
        $this->foodMock->expects($this->once())
                ->method('getFat')
                ->will($this->returnValue($gram));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // ReflectionClassを使ってprotectedメソッドのcalcFatCalorieにアクセスする
        $reflection = new \ReflectionClass($pfc);
        $property = $reflection->getMethod('calcFatCalorie');
        $property->setAccessible(true);

        // 脂質のカロリーが1(g)=9(kcal)で計算され、整数であることを確認する
        $this->assertSame($property->invoke($pfc), $total);
    }

    /**
     * provide test fat data
     * テスト用の脂質データ
     *
     * @return array
     */
    public function provideTestFatData()
    {
        return [
            [1, (int)9], // 整数での計算
            [1.2, (int)11], // グラム数が小数点、トータルが四捨五入される
            [1.555555, (int)14], // グラム数が小数点第二位で四捨五入される
        ];
    }

    /**
     * test calcCarbohydrateCalorie
     * 炭水化物のカロリーを求める
     *
     * @test
     * @dataProvider provideTestCarbohydrateData
     * @param int|float $gram
     * @param int $total
     */
    public function testCalcCarbohydrateCalorie(int|float $gram, int $total): void
    {
        /**
         * 食品Mockを作成し、dataProviderからグラム数を設定する
         */
        $this->foodMock->expects($this->once())
                ->method('getCarbohydrate')
                ->will($this->returnValue($gram));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // ReflectionClassを使ってprotectedメソッドのcalcCarbohydrateCalorieにアクセスする
        $reflection = new \ReflectionClass($pfc);
        $property = $reflection->getMethod('calcCarbohydrateCalorie');
        $property->setAccessible(true);

        // 炭水化物のカロリーが1(g)=4(kcal)で計算され、整数であることを確認する
        $this->assertSame($property->invoke($pfc), $total);
    }

    /**
     * provide test carbohydrate data
     * テスト用炭水化物データ
     *
     * @return arary
     */
    public function provideTestCarbohydrateData()
    {
        return [
            [1, (int)4], // 整数での計算
            [1.2, (int)5], // グラム数が小数点、トータルが四捨五入される
            [1.555555, (int)6], // グラム数が小数点第二位で四捨五入される
        ];
    }

    /**
     * test calcCalorie
     * 三大栄養素から食品の総カロリーを計算するテスト
     *
     * @test
     * @dataProvider provideTestCalorieData
     * @param int|float $protein
     * @param int|float $fat
     * @param int|float $carbohydrate
     * @param int $total
     */
    public function testCalcCalorie(
        int|float $protein,
        int|float $fat,
        int|float $carbohydrate,
        int $total
    ): void {
        /**
         * 食品Mockを作成して、たんぱく質、脂質、炭水化物
         * をdataProviderから設定する
         */
        $this->foodMock->expects($this->any(0))
                ->method('getProtein')
                ->will($this->returnValue($protein));

        $this->foodMock->expects($this->any(1))
                ->method('getFat')
                ->will($this->returnValue($fat));

        $this->foodMock->expects($this->any(2))
                ->method('getCarbohydrate')
                ->will($this->returnValue($carbohydrate));

        // 作成した食品Mockをコンストラクター・インジェクション
        $pfc = new Pfc($this->foodMock);

        // たんぱく質、脂質、炭水化物のカロリーが正しく計算され、整数であることを確認する
        $this->assertSame($pfc->calcCalorie($pfc), $total);
    }

    /**
     * provide test calorie data
     * テスト用のデータ
     *
     * @return array
     */
    public function provideTestCalorieData()
    {
        return [
            [1, 1, 1, (int)17], // 整数での計算
            [1.2, 1.2, 1.2, (int)21], // グラム数が小数点、トータルが四捨五入される
            [1.555555, 1.55555, 1.55555, (int)26], // グラム数が小数点第二位で四捨五入される
            [2.5, 0.3, 37.1, (int)161], // 白米
            [16.5, 10.0, 12.1, (int)204], // 納豆
        ];
    }
}
