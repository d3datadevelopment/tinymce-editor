<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright (C) 2022 Marat Bedoev, bestlife AG
 * @copyright (C) 2023 O3-Shop (https://www.o3-shop.com)
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types=1);

namespace O3\TinyMCE\Application\Core\TinyMCE\Options;

class Toolbar extends AbstractOption
{
    protected string $key = 'toolbar';

    protected bool $forceSingleLineToolbar = true;

    public function __construct(protected iterable $toolbars, protected iterable $plugins)
    {
    }

    public function get(): string
    {
        return $this->forceSingleLineToolbar ?
            $this->getSingleLineToolbar() :
            $this->getMultiLineToolbar();
    }

    protected function getSingleLineToolbar(): string
    {
        $toolbarElements = implode(
            ' | ',
            iterator_to_array(
                (function () {
                    foreach ($this->toolbars as $toolbar) {
                        $buttons = $toolbar->getButtons();
                        if ($buttons) {
                            yield implode(' ', $buttons);
                        }
                    }
                })()
            )
        );

        $pluginToolbarElements = implode(
            ' | ',
            iterator_to_array(
                (function () {
                    foreach ($this->plugins as $plugin) {
                        $elements = $plugin->getToolbarElements();

                        if ($elements) {
                            yield implode(' ', $elements);
                        }
                    }
                })()
            )
        );

        return $toolbarElements . ' | ' . $pluginToolbarElements;
    }

    /**
     * @return string
     */
    protected function getMultiLineToolbar(): string
    {
        $list = [];

        foreach ($this->toolbars as $toolbar) {
            $list[] = implode(
                ' | ',
                array_filter(
                    array_map(
                        function ($toolbarElement) {
                            return implode(
                                ' ',
                                $toolbarElement->getButtons()
                            );
                        },
                        $toolbar
                    )
                )
            );
        }

        $list[] = implode(
            ' | ',
            iterator_to_array(
                (function () {
                    foreach ($this->plugins as $plugin) {
                        $elements = $plugin->getToolbarElements();

                        if ($elements) {
                            yield implode(' ', $elements);
                        }
                    }
                })()
            )
        );

        return '["'.implode('", "', $list).'"]';
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
