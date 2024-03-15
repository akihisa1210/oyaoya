<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

class RawText
{
    public function __construct(readonly public string $text)
    {
    }
}
