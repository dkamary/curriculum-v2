<?php

namespace App\Twig;

use Twig\Extension\RuntimeExtensionInterface;

class ButtonRuntime implements RuntimeExtensionInterface
{
    const TPL_BUTTON = '<button %s class="%s %s"%s>%s%s%s</button>';
    const TPL_LINK = '<a href="%s" class="%s %s"%s>%s%s%s</a>';
    const DEFAULT_PARAMS = [
        'button' => true,
        'class' => '',
        'type' => 'button',
        'style' => 'default',
        'attr' => [],
        'attr_prefix' => '',
        'attr_separator' => '',
        'link' => '#',
        'link_display' => false,
        'icon_class' => '',
        'icon_placement' => 'left',
        'icon_library' => 'fa',
        'btn_class' => 'genric-btn',
        'outline' => false,
        'rounded' => false,
        'size' => '',
    ];

    public function __construct()
    {
        //
    }

    /**
     * Display button
     *
     * @param string $text
     * @param array $params
     * @return string
     */
    public function display(string $text, array $params = []): string
    {
        $params = array_merge(self::DEFAULT_PARAMS, $params);
        $tpl = $params['button'] ? self::TPL_BUTTON : self::TPL_LINK;
        if ($params['button']) {
            $params['attr']['type'] = $params['type'];
        }
        $class = $params['btn_class'] . ' ' . $params['style']
            . ($params['outline'] ? '-border' : '')
            . ($params['rounded'] ? ' circle' : '')
            . ($params['size'] != '' ? $params['size'] : '');

        $button = sprintf(
            $tpl,
            $params['button'] ? '' : $params['link'], // href
            $class, // button class
            $params['class'], // custom class
            $this->displayAttr($params['attr'], $params['attr_prefix'], $params['attr_separator']), // attributes
            ($params['icon_class'] != '' && $params['icon_placement'] == 'left') ? $this->displayIcon($params['icon_library'], $params['icon_class']) . '&nbsp;' : '', // Icon left
            $text, // button text
            ($params['icon_class'] != '' && $params['icon_placement'] == 'right') ? '&nbsp;' . $this->displayIcon($params['icon_library'], $params['icon_class']) : '' // Icon right
        );

        return $button;
    }

    /**
     * Display button attribute
     *
     * @param array $attrs
     * @param string $prefix
     * @param string $separator
     * @return string
     */
    private function displayAttr(array $attrs, string $prefix = '', string $separator = '-'): string
    {
        $display = '';
        $hasPrefix = $prefix != '';
        foreach ($attrs as $key => $value) {
            $display .= ' ';
            if (is_int($key)) {
                $display .= $value;
            } else {
                $display .= ($hasPrefix ? $prefix . $separator : '') . $key . '="' . htmlspecialchars($value) . '"';
            }
        }

        return $display;
    }

    /**
     * Display icon button
     *
     * @param string $library
     * @param string $iconClass
     * @return string
     */
    private function displayIcon(string $library, string $iconClass): string
    {
        $tpl = '<i class="%s %s" aria-hidden="true"></i>';
        $icon = sprintf($tpl, $library, $iconClass);

        return $icon;
    }
}
