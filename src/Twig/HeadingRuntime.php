<?php

namespace App\Twig;

use Twig\Extension\RuntimeExtensionInterface;

class HeadingRuntime implements RuntimeExtensionInterface
{
    const TPL = '<% class="%">%s</%>';
    const DEFAULT_PARAMS = [
        'class' => 'text-heading',
        'tag' => 'h2',
    ];

    /**
     * Display heading
     *
     * @param string $text
     * @param array $params
     * @return string
     */
    public function display(string $text, array $params = []): string
    {
        $params = array_merge(self::DEFAULT_PARAMS, $params);
        $heading = sprintf(
            self::TPL,
            $params['tag'],
            $params['class'],
            $text,
            $params['tag']
        );

        return $heading;
    }
}
