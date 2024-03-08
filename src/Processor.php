<?

namespace Akihisa1210\Oyaoya;

class Processor
{
    public function __construct(readonly private string $text)
    {
    }

    private function convertToKana()
    {
        $escaped_text = escapeshellcmd($this->text);
        $output = null;
        $retval = null;

        // mecab -Oyomiは与えられた文字列をカタカナに変換する
        exec("echo {$escaped_text} | mecab -Oyomi", $output, $retval);

        if ($retval !== 0) {
            throw new \Exception("mecab exited with status {$retval}");
        }

        // TODO 変換結果に漢字が残っていたら落とす

        return $output[0];
    }

    public function countInNICOLA()
    {
        return mb_strlen($this->convertToKana());
    }

    public function countInRomaji()
    {
        // TODO countInNICOLAとcountInRomajiの両方でconvertToKana()を呼び出しており非効率
        $chars = mb_str_split($this->convertToKana());

        // アイウエオは1打鍵
        // キシチニヒミリギジヂビピは後ろに小さい文字が来ると3打鍵で入力できる拗音になりうる
        // 小さいッの後に母音以外が来る場合は、次の文字と合わせて3打鍵になる
        // ンは、次の文字が母音以外であれば1打鍵になる
        // ャュョッは単体の場合は3打鍵
        // 他のカタカナは2打鍵
        // カタカナ以外は1打鍵
        $count = 0;
        for ($i = 0; $i < count($chars); $i++) {
            $char = $chars[$i];
            if (in_array($char, ["ア", "イ", "ウ", "エ", "オ"])) {
                $count++;
            } else if (in_array($char, [
                "キ", "シ", "チ", "ニ", "ヒ", "ミ", "リ",
                "ギ", "ジ", "ヂ", "ビ", "ピ",
            ])) {
                if ($i + 1 < count($chars) && in_array($chars[$i + 1], ["ャ", "ュ", "ョ"])) {
                    $count += 3;
                    $i++;
                } else {
                    $count += 2;
                }
            } else if (in_array($char, ["ッ"])) {
                if ($i + 1 < count($chars) && !in_array($chars[$i + 1], ["ア", "イ", "ウ", "エ", "オ"])) {
                    $count += 3;
                    $i++;
                } else {
                    $count += 3;
                }
            } else if (in_array($char, ["ン"])) {
                if ($i + 1 < count($chars) && !in_array($chars[$i + 1], ["ア", "イ", "ウ", "エ", "オ"])) {
                    $count++;
                } else {
                    $count += 2;
                }
            } else if (in_array($char, ["ャ", "ュ", "ョ"])) {
                $count += 3;
            } else if (in_array($char, [
                "カ", "キ", "ク", "ケ", "コ",
                "サ", "シ", "ス", "セ", "ソ",
                "タ", "チ", "ツ", "テ", "ト",
                "ナ", "ニ", "ヌ", "ネ", "ノ",
                "ハ", "ヒ", "フ", "ヘ", "ホ",
                "マ", "ミ", "ム", "メ", "モ",
                "ヤ", "ユ", "ヨ",
                "ラ", "リ", "ル", "レ", "ロ",
                "ワ", "ヰ", "ヱ", "ヲ",
                "ン",
                "ガ", "ギ", "グ", "ゲ", "ゴ",
                "ザ", "ジ", "ズ", "ゼ", "ゾ",
                "ダ", "ヂ", "ヅ", "デ", "ド",
                "バ", "ビ", "ブ", "ベ", "ボ",
                "パ", "ピ", "プ", "ペ", "ポ",
                "ァ", "ィ", "ゥ", "ェ", "ォ",
                "ッ", "ャ", "ュ", "ョ",
                "ヴ",
            ])) {
                $count += 2;
            } else {
                $count++;
            }
        }

        return $count;
    }
}
