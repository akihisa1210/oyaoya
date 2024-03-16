<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

class NicolaKeystrokes implements KeystrokesInterface
{
    public function __construct(readonly public ToKanaTextPreprocessor $preprocessor)
    {
    }

    public function count(RawText $raw_text): KeystrokesCount
    {
        $preprocessed_text = $this->preprocessor->process($raw_text);

        // TODO このクラスを修正した場合も、カナ変換することを忘れないようにしたい

        $result = new KeystrokesCount(mb_strlen($preprocessed_text->text));
        return $result;
    }
}
