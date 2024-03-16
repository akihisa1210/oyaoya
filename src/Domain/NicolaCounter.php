<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

use Akihisa1210\Oyaoya\External\KanaConverterInterface;

readonly final class NicolaCounter implements CounterInterface
{
    public function __construct(public KanaConverterInterface $kana_converter)
    {
    }

    public function count(string $text): Keystrokes
    {
        $converted_text = $this->kana_converter->convert($text);
        return new Keystrokes(mb_strlen($converted_text));
    }
}
