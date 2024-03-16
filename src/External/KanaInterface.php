<?php

namespace Akihisa1210\Oyaoya\External;

interface KanaInterface
{
    public function convert(string $text): string;
}
