<?php

namespace Akihisa1210\Oyaoya\External;

use Exception;

final class MecabKanaConverter implements KanaConverterInterface
{
    public function convert(string $text): string
    {
        $escaped_text = escapeshellcmd($text);
        $escaped_text_size = strlen($escaped_text);
        $output = null;
        $retval = null;

        // -Oyomiは与えられた文字列をカタカナに変換する
        // -bは入力文字列のバイト数（指定しないと、文字列が長いときにエラーが発生する）
        exec("echo {$escaped_text} | mecab -Oyomi -b {$escaped_text_size}", $output, $retval);

        if ($retval !== 0) {
            throw new Exception("mecab exited with status {$retval}");
        }

        // TODO 変換結果に漢字が残っていたら落とす

        return $output[0];
    }
}
