<?php

namespace test\Unit;

require_once 'Libs/Natto.php';

use PHPUnit\Framework\TestCase;
use Libs\Natto;
use Libs\FoodInterface;

/**
 * test natto
 * 納豆の三大栄養素を管理するClassのテスト
 *
 * たんぱく質、脂質、炭水化物の値を正しく返すか、整数かを確認します。
 * また、FoodInterfaceのインスタンスかを確認します。。
 */
class NattoTest extends TestCase
{
    protected Natto $natto;

    protected function setUp(): void
    {
        $this->natto = new Natto();
    }

    /**
     * test getProtein
     * 納豆のたんぱく質の戻り値をテストする
     *
     * @test
     */
    public function testGetProtein(): void
    {
        // インスタンスがFoodInterfaceのインスタンスかを確認
        $this->assertInstanceOf(FoodInterface::class, $this->natto);

        // たんぱく質の戻り値が16.5でかつfloat型であるか確認する
        $this->assertSame($this->natto->getProtein(), 16.5);
    }

    /**
     * test getFat
     * 納豆の脂質の戻り値をテストする
     *
     * @test
     */
    public function testGetFat(): void
    {
        // インスタンスがFoodInterfaceのインスタンスかを確認
        $this->assertInstanceOf(FoodInterface::class, $this->natto);

        // 脂質の戻り値が10.0でかつfloat型であるか確認する
        $this->assertSame($this->natto->getFat(), 10.0);
    }

    /**
     * test getCarbohydrate
     * 納豆の炭水化物の戻り値をテストする
     *
     * @test
     */
    public function testGetCarbohydrate(): void
    {
        // インスタンスがFoodInterfaceのインスタンスかを確認
        $this->assertInstanceOf(FoodInterface::class, $this->natto);

        // 炭水化物の戻り値が12.1でかつfloat型であるか確認する
        $this->assertSame($this->natto->getCarbohydrate(), 12.1);
    }
}
