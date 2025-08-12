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

use O3\TinyMCE\Application\Core\TinyMCE\Loader;
use O3\TinyMCE\Application\Core\TinyMCE\PluginList;
use O3\TinyMCE\Application\Core\TinyMCE\Plugins\PluginInterface;
use O3\TinyMCE\Application\Core\TinyMCE\ToolbarList;

class Toolbar extends AbstractOption
{
    protected string $key = 'toolbar';

    protected bool $forceSingleLineToolbar = true;

    public function __construct(protected Loader $loader)
    {
        parent::__construct($loader);
    }

    public function get(): string
    {
        $toolbarList = oxNew(ToolbarList::class);

        return $this->forceSingleLineToolbar ?
            $this->getSingleLineToolbar($toolbarList) :
            $this->getMultiLineToolbar($toolbarList);
    }

    /**
     * @param ToolbarList $toolbarList
     * @return string
     */
    protected function getSingleLineToolbar(ToolbarList $toolbarList): string
    {
        $all = [];

        foreach ($toolbarList->get() as $toolbar) {
            $all = array_merge($all, $toolbar);
        }

        $toolbarElements = implode(
            ' | ',
            array_filter(
                array_map(
                    function ($toolbarElement) {
                        return implode(
                            ' ',
                            $toolbarElement->getButtons()
                        );
                    },
                    $all
                )
            )
        );

        $pluginList = oxNew(PluginList::class);
        $pluginToolbarElements = implode(
            ' | ',
            array_filter(
                array_map(
                    function (PluginInterface $plugin) {
                        return count($plugin->getToolbarElements()) ? implode(
                            ' ',
                            $plugin->getToolbarElements()
                        ) : null;
                    },
                    $pluginList->get()
                )
            )
        );

        return $toolbarElements . ' | ' . $pluginToolbarElements;
    }

    /**
     * @param ToolbarList $toolbarList
     * @return string
     */
    protected function getMultiLineToolbar(ToolbarList $toolbarList): string
    {
        $list = [];

        foreach ($toolbarList->get() as $toolbar) {
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

        $pluginList = oxNew(PluginList::class);
        $list[] = implode(
            ' | ',
            array_filter(
                array_map(
                    function (PluginInterface $plugin) {
                        return count($plugin->getToolbarElements()) ? implode(
                            ' ',
                            $plugin->getToolbarElements()
                        ) : null;
                    },
                    $pluginList->get()
                )
            )
        );

        return '["'.implode('", "', $list).'"]';
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
