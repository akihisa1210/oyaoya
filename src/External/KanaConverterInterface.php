<?php

namespace Akihisa1210\Oyaoya\External;

interface KanaConverterInterface
{
    public function convert(string $text): string;
}
