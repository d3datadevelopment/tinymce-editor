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
use O3\TinyMCE\Application\Core\TinyMCE\Plugins\Quickbars;

class QuickbarsInsertToolbar extends AbstractOption
{
    protected string $key = 'quickbars_insert_toolbar';

    public function get(): string
    {
        return 'false';
        /*
                return implode(
                    ' | ',
                    [
                        // 'quickimage', // disabled, as images are only inserted inline. This is too much for a typical database field length.
                        'quicktable',
                        'hr',
                        'pagebreak'
                    ]
                );
        */
    }

    public function isQuoted(): bool
    {
        return $this->get() !== 'false';
    }

    public function requireRegistration(): bool
    {
        $pluginList = oxNew(PluginList::class);

        return in_array(
            true,
            array_map(
                function (PluginInterface $plugin) {
                    return $plugin instanceof Quickbars;
                },
                $pluginList->get(),
            )
        );
    }
}
