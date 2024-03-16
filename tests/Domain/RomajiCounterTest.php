<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Akihisa1210\Oyaoya\Domain\RomajiCounter;
use Akihisa1210\Oyaoya\External\MecabKanaConverter;

class RomajiCounterTest extends TestCase
{
    /**
     * @return array<array<string|int>>
     */
    public static function romajiTextProvider(): array
    {
        return [
            ["ア", 1],
            ["カ", 2],
            ["a", 1],
            ["(", 1],
            ["キ", 2],
            ["キャ", 3],
            ["キリ", 4],
            ["ニッキ", 5], // nikki
            ["ニッイ", 6], // niltui
            ["ニッ", 5], // niltu
            ["ン", 2],
            ["アンキ", 4], // anki
            ["アンイ", 4], // anni
            ["アニ", 3],
            ["ャ", 3],
            ["ュ", 3],
            ["ョ", 3],
            ["ッ", 3],
            ["アスハキョウヨリキオンガキットタカイ、ゲンインハナゾダョ。", 48], // asuha kyou yori kion ga kitto takai、gennin ha nazo da lyo。
            ["改行\nがある場合", 16], // カイギョウガアルバアイ kaigyou ga aru baai
        ];
    }

    /**
     * @param string $text
     * @param integer $expected
     * @return void
     */
    #[DataProvider("romajiTextProvider")]
    public function testCountInRomaji(string $text, int $expected)
    {
        $romaji_counter = new RomajiCounter(new MecabKanaConverter());
        $result = $romaji_counter->count($text);
        $this->assertEquals($expected, $result->keystrokes);
    }
}
