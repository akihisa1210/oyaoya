<?

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Akihisa1210\Oyaoya\Processor;

class ProcessorTest extends TestCase
{
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

    #[DataProvider("NICOLETextProvider")]
    public function testCountInNICOLA(string $input, int $expected)
    {
        $processor = new Processor($input);
        $this->assertEquals($expected, $processor->countInNICOLA());
    }

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


    #[DataProvider("romajiTextProvider")]
    public function testCountI(string $input, int $expected)
    {
        $processor = new Processor($input);
        $this->assertEquals($expected, $processor->countInRomaji());
    }
}
