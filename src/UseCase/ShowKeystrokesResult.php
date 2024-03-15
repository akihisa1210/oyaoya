<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\UseCase;

use Akihisa1210\Oyaoya\Domain\InputMethodEnum;
use Akihisa1210\Oyaoya\Domain\KeystrokesCount;

class ShowKeystrokesResult
{
    public function __construct(private KeystrokesCount $nicola_count, private KeystrokesCount $romaji_count)
    {
    }

    /**
     * @return array<string, int> The array containing the keystrokes count for each input method.
     */
    public function get(): array
    {
        return [
            InputMethodEnum::NICOLA => $this->nicola_count->count,
            InputMethodEnum::ROMAJI => $this->romaji_count->count
        ];
    }
}
