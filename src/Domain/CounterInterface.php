<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

interface CounterInterface
{
    public function count(string $text): Keystrokes;
}
