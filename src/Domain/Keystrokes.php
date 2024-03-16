<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

readonly final class Keystrokes
{
    public function __construct(public int $keystrokes)
    {
    }
}
