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

use O3\TinyMCE\Application\Core\TinyMCE\Plugins\PluginInterface;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\ToolbarInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class Toolbar extends AbstractOption
{
    protected string $key = 'toolbar';

    /**
     * @param iterable<ToolbarInterface> $toolbars
     * @param iterable<PluginInterface> $plugins
     */
    public function __construct(
        #[TaggedIterator('d3tinymce.toolbar')]
        protected iterable $toolbars,
        #[TaggedIterator('d3tinymce.plugin')]
        protected iterable $plugins
    ) {
    }

    public function get(): string
    {
        return $this->getSingleLineToolbar();
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

    public function isQuoted(): bool
    {
        return true;
    }
}
