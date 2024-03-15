<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\UseCase;

use Akihisa1210\Oyaoya\Domain\NicolaKeystrokes;
use Akihisa1210\Oyaoya\Domain\RomajiKeystrokes;
use Akihisa1210\Oyaoya\Domain\RawText;

class ShowKeystrokesUseCase
{
    public function __construct()
    {
    }

    public function execute(string $text): ShowKeystrokesResult
    {
        $raw_text = new RawText($text);

        $nicola_keystrokes = new NicolaKeystrokes();
        $nicola_count = $nicola_keystrokes->count($raw_text);

        $romaji_keystrokes = new ROMAJIKeystrokes();
        $romaji_count = $romaji_keystrokes->count($raw_text);

        return new ShowKeystrokesResult($nicola_count, $romaji_count);
    }
}
