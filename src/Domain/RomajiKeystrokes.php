<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

class RomajiKeystrokes implements KeystrokesInterface
{
    public function __construct(readonly public ToKanaTextPreprocessor $preprocessor)
    {

    }

    public function count(RawText $raw_text): KeystrokesCount
    {
        $processed_text = $this->preprocessor->process($raw_text);

        $chars = mb_str_split($processed_text->text);

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

        return new KeystrokesCount($count);
    }
}
