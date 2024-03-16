<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

use Akihisa1210\Oyaoya\External\KanaInterface;

class ToKanaTextPreprocessor implements TextPreprocessorInterface
{
    public function __construct(readonly private KanaInterface $kana)
    {
    }

    public function process(RawText $raw_text): PreprocessedText
    {
        $kana_text = $this->kana->convert($raw_text->text);
        return new PreprocessedText($kana_text);
    }
}
