<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\UseCase;

use Akihisa1210\Oyaoya\Domain\NicolaCounter;
use Akihisa1210\Oyaoya\Domain\RomajiCounter;
use Akihisa1210\Oyaoya\External\MecabKanaConverter;

class ShowKeystrokesUseCase
{
    public function __construct()
    {
    }

    public function execute(string $text): ShowKeystrokesResult
    {
        $mecab_kana_converter = new MecabKanaConverter();

        $nicola_counter = new NicolaCounter($mecab_kana_converter);
        $nicola_keystrokes = $nicola_counter->count($text);

        $romaji_counter = new RomajiCounter($mecab_kana_converter);
        $romaji_keystrokes = $romaji_counter->count($text);

        return new ShowKeystrokesResult($nicola_keystrokes, $romaji_keystrokes);
    }
}
