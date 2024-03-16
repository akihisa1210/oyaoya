<?php

declare(strict_types=1);

namespace Akihisa1210\Oyaoya\UseCase;

use Akihisa1210\Oyaoya\Domain\NicolaKeystrokes;
use Akihisa1210\Oyaoya\Domain\RawText;
use Akihisa1210\Oyaoya\Domain\RomajiKeystrokes;
use Akihisa1210\Oyaoya\Domain\ToKanaTextPreprocessor;
use Akihisa1210\Oyaoya\External\MecabKana;

class ShowKeystrokesUseCase
{
    public function __construct()
    {
    }

    public function execute(string $text): ShowKeystrokesResult
    {
        $raw_text = new RawText($text);

        $kana = new MecabKana();
        $to_kana_text_preprocessor = new ToKanaTextPreprocessor($kana);

        $nicola_keystrokes = new NicolaKeystrokes($to_kana_text_preprocessor);
        $nicola_count = $nicola_keystrokes->count($raw_text);

        $romaji_keystrokes = new ROMAJIKeystrokes($to_kana_text_preprocessor);
        $romaji_count = $romaji_keystrokes->count($raw_text);

        return new ShowKeystrokesResult($nicola_count, $romaji_count);
    }
}
