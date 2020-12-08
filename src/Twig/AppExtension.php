<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('button', [ButtonRuntime::class, 'display'], ['is_safe' => ['html']]),
            new TwigFilter('heading', [HeadingRuntime::class, 'display'], ['is_safe' => ['html']]),
        ];
    }
}
