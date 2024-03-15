<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\Domain;

interface KeystrokesInterface
{
    public function count(RawText $raw_text): KeystrokesCount;
}
