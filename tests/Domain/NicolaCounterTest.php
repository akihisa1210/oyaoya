<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Akihisa1210\Oyaoya\Domain\NicolaCounter;
use Akihisa1210\Oyaoya\External\MecabKanaConverter;

class NicolaCounterTest extends TestCase
{
    /**
     * @return array<array<string|int>>
     */
    public static function NicolaTextProvider(): array
    {
        return [
            ["ア", 1],
            ["あ", 1],
            ["a", 1],
            ["(", 1],
            ["、。", 2],
            ["漢字ひらがなカタカナ", 11], // カンジヒラガナカタカナ
            ["改行\nがある場合", 11], // カイギョウガアルバアイ
        ];
    }

    /**
     * @param string $text
     * @param integer $expected
     * @return void
     */
    #[DataProvider("NicolaTextProvider")]
    public function testCountKeystrokesInNICOLA(string $text, int $expected)
    {
        $nicola_counter = new NicolaCounter(new MecabKanaConverter());
        $result = $nicola_counter->count($text);
        $this->assertEquals($expected, $result->keystrokes);
    }
}
