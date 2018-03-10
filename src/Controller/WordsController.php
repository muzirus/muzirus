<?php

namespace App\Controller;

use App\Repository\CzechWordRepository;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class WordsController extends AbstractController
{

    private function getCzechLetters(): array
    {
        return [
            'a',
            'á',
            'b',
            'c',
            'č',
            'd',
            'ď',
            'e',
            'é',
            'ě',
            'f',
            'g',
            'h',
            'ch',
            'i',
            'í',
            'j',
            'k',
            'l',
            'm',
            'n',
            'ň',
            'o',
            'ó',
            'p',
            'q',
            'r',
            'ř',
            's',
            'š',
            't',
            'ť',
            'u',
            'ú',
            'ů',
            'v',
            'w',
            'x',
            'y',
            'ý',
            'z',
            'ž',
        ];
    }

    private function getRussianLetters(): array
    {
        return [
            'а',
            'б',
            'в',
            'г',
            'д',
            'е',
            'ё',
            'ж',
            'з',
            'и',
            'й',
            'к',
            'л',
            'м',
            'н',
            'о',
            'п',
            'р',
            'с',
            'т',
            'у',
            'ф',
            'х',
            'ц',
            'ч',
            'ш',
            'щ',
            'ъ',
            'ы',
            'ь',
            'э',
            'ю',
            'я',
        ];
    }
}
