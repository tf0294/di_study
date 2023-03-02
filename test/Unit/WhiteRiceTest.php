<?php

namespace test\Unit;

require_once 'Libs/WhiteRice.php';

use PHPUnit\Framework\TestCase;
use Libs\WhiteRice;
use Libs\FoodInterface;

/**
 * test whiteRice
 * 白米の三大栄養素を管理するClassのテスト
 *
 * たんぱく質、脂質、炭水化物の値を正しく返すか、整数かを確認します。
 * また、FoodInterfaceのインスタンスかを確認します。
 */
class WhiteRiceTest extends TestCase
{
    protected WhiteRice $whiteRice;

    protected function setUp(): void
    {
        $this->whiteRice = new WhiteRice();
    }

    /**
     * test getProtein
     * 白米のたんぱく質の戻り値をテストする
     *
     * @test
     */
    public function testGetProtein(): void
    {
        // インスタンスがFoodInterfaceのインスタンスかを確認
        $this->assertInstanceOf(FoodInterface::class, $this->whiteRice);

        // たんぱく質の戻り値が2.5でかつfloat型であるか確認する
        $this->assertSame($this->whiteRice->getProtein(), 2.5);
    }

    /**
     * test getFat
     * 白米の脂質の戻り値をテストする
     *
     * @test
     */
    public function testGetFat(): void
    {
        // インスタンスがFoodInterfaceのインスタンスかを確認
        $this->assertInstanceOf(FoodInterface::class, $this->whiteRice);

        // 脂質の戻り値が0.3でかつfloat型であるか確認する
        $this->assertSame($this->whiteRice->getFat(), 0.3);
    }

    /**
     * test getCarbohydrate
     * 白米の炭水化物の戻り値をテストする
     *
     * @test
     */
    public function testGetCarbohydrate(): void
    {
        // インスタンスがFoodInterfaceのインスタンスかを確認
        $this->assertInstanceOf(FoodInterface::class, $this->whiteRice);

        // 炭水化物の戻り値が37.1でかつfloat型であるか確認する
        $this->assertSame($this->whiteRice->getCarbohydrate(), 37.1);
    }
}
