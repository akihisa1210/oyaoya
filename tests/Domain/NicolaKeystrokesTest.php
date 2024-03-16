<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Akihisa1210\Oyaoya\Domain\NicolaKeystrokes;
use Akihisa1210\Oyaoya\Domain\RawText;
use Akihisa1210\Oyaoya\Domain\ToKanaTextPreprocessor;
use Akihisa1210\Oyaoya\External\MecabKana;

class NicolaKeystrokesTest extends TestCase
{
    /**
     * @return array<array<string|int>>
     */
    public static function NICOLETextProvider(): array
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
    #[DataProvider("NICOLETextProvider")]
    public function testCountKeystrokesInNICOLA(string $text, int $expected)
    {
        $kana = new MecabKana();
        $to_kana_text_preprocessor = new ToKanaTextPreprocessor($kana);
        $nicola_keystrokes = new NicolaKeystrokes($to_kana_text_preprocessor);
        $raw_text = new RawText($text);
        $result = $nicola_keystrokes->count($raw_text);
        $this->assertEquals($expected, $result->count);
    }
}
