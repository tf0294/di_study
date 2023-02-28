<?php

namespace test\Unit;

require_once 'Libs/Natto.php';

use PHPUnit\Framework\TestCase;
use Libs\Natto;

/**
 * test natto
 * 納豆の三大栄養素を管理するClassのテスト
 */
class NattoTest extends TestCase
{
    protected natto $natto;

    protected function setUp(): void
    {
        $this->natto = new natto();
    }

    /**
     * test getProtein
     * 納豆のたんぱく質の戻り値をテストする
     */
    public function testGetProtein(): void
    {
        // たんぱく質の戻り値が16.5でかつfloat型であるか確認する
        $this->assertSame($this->natto->getProtein(), 16.5);
    }

    /**
     * test getFat
     * 納豆の脂質の戻り値をテストする
     */
    public function testGetFat(): void
    {
        // 脂質の戻り値が10.0でかつfloat型であるか確認する
        $this->assertSame($this->natto->getFat(), 10.0);
    }

    /**
     * test getCarbohydrate
     * 納豆の炭水化物の戻り値をテストする
     */
    public function testGetCarbohydrate(): void
    {
        // 炭水化物の戻り値が12.1でかつfloat型であるか確認する
        $this->assertSame($this->natto->getCarbohydrate(), 12.1);
    }
}
