<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Akihisa1210\Oyaoya\Domain\RawText;
use Akihisa1210\Oyaoya\Domain\RomajiKeystrokes;
use Akihisa1210\Oyaoya\Domain\ToKanaTextPreprocessor;
use Akihisa1210\Oyaoya\External\MecabKana;

class RomajiKeyStrokesTest extends TestCase
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
    public function testCountI(string $text, int $expected)
    {
        $kana = new MecabKana();
        $to_kana_text_preprocessor = new ToKanaTextPreprocessor($kana);
        $romaji_keystrokes = new RomajiKeystrokes($to_kana_text_preprocessor);
        $raw_text = new RawText($text);
        $result = $romaji_keystrokes->count($raw_text);
        $this->assertEquals($expected, $result->count);
    }
}
