<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\UseCase;

use Akihisa1210\Oyaoya\Domain\InputMethodEnum;
use Akihisa1210\Oyaoya\Domain\Keystrokes;

readonly final class ShowKeystrokesResult
{
    public function __construct(private Keystrokes $nicola_keystrokes, private Keystrokes $romaji_keystrokes)
    {
    }

    /**
     * @return array<string, int> The array containing the keystrokes count for each input method.
     */
    public function get(): array
    {
        return [
            InputMethodEnum::NICOLA => $this->nicola_keystrokes->keystrokes,
            InputMethodEnum::ROMAJI => $this->romaji_keystrokes->keystrokes
        ];
    }
}
