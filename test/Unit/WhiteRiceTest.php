<?php

namespace test\Unit;

require_once 'Libs/WhiteRice.php';

use PHPUnit\Framework\TestCase;
use Libs\WhiteRice;

/**
 * test whiteRice
 * 白米の三大栄養素を管理するClassのテスト
 */
class WhiteRiceTest extends TestCase
{
    protected whiteRice $whiteRice;

    protected function setUp(): void
    {
        $this->whiteRice = new whiteRice();
    }

    /**
     * test getProtein
     * 白米のたんぱく質の戻り値をテストする
     */
    public function testGetProtein(): void
    {
        // たんぱく質の戻り値が2.5でかつfloat型であるか確認する
        $this->assertSame($this->whiteRice->getProtein(), 2.5);
    }

    /**
     * test getFat
     * 白米の脂質の戻り値をテストする
     */
    public function testGetFat(): void
    {
        // 脂質の戻り値が0.3でかつfloat型であるか確認する
        $this->assertSame($this->whiteRice->getFat(), 0.3);
    }

    /**
     * test getCarbohydrate
     * 白米の炭水化物の戻り値をテストする
     */
    public function testGetCarbohydrate(): void
    {
        // 炭水化物の戻り値が37.1でかつfloat型であるか確認する
        $this->assertSame($this->whiteRice->getCarbohydrate(), 37.1);
    }
}
