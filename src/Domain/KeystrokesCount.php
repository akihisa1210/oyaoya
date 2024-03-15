<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

class KeystrokesCount
{
    public function __construct(readonly public int $count)
    {
    }
}
