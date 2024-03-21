<?php

namespace Akihisa1210\Oyaoya\External;

use Exception;

final class MecabKanaConverter implements KanaConverterInterface
{
    public function convert(string $text): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'oyaoya_');
        if ($tempFile === false) {
            throw new Exception("failed to create temporary file to reading the given text");
        }

        try {
            file_put_contents($tempFile, $text);

            $text_size = strlen($text);
            $output = null;
            $retval = null;

            // -Oyomiは与えられた文字列をカタカナに変換する（ただし、一部の漢字は残る）
            // -bは入力文字列のバイト数（指定しないと、文字列が長いときにエラーが発生する）
            exec("cat {$tempFile} | mecab -Oyomi -b {$text_size}", $output, $retval);
            unlink($tempFile);

            if ($retval !== 0) {
                // TODO 標準エラー出力を取得してエラーメッセージを表示する
                throw new Exception("exec() exited with status {$retval}");
            }

            return implode('', $output);
        } catch (Exception $e) {
            throw $e;
        } finally {
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }
        }
    }
}
