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

use O3\TinyMCE\Application\Core\TinyMCE\PluginList;
use O3\TinyMCE\Application\Core\TinyMCE\Plugins\PluginInterface;
use O3\TinyMCE\Application\Core\TinyMCE\Utils;

class ExternalPlugins extends AbstractOption
{
    protected string $key = 'external_plugins';

    public function get(): string
    {
        $pluginList = oxNew(PluginList::class);

        $list = implode(
            ', ',
            array_filter(
                array_map(
                    function (PluginInterface $plugin) {
                        return $plugin->getScriptPath() ? implode(
                            ':',
                            [
                                (oxNew(Utils::class))->quote($plugin->getPluginName()),
                                (oxNew(Utils::class))->quote($plugin->getScriptPath()),
                            ]
                        ) : null;
                    },
                    $pluginList->get()
                )
            )
        );

        return '{ '.$list.' }';
    }
}
