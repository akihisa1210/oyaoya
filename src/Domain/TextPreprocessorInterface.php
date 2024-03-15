<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

interface TextPreprocessorInterface
{
    public function process(RawText $raw_text): PreprocessedText;
}
