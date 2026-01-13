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

use Generator;
use O3\TinyMCE\Application\Core\TinyMCE\Utils;

class ExternalPlugins extends AbstractOption
{
    protected string $key = 'external_plugins';

    public function __construct(protected iterable $plugins)
    {
    }

    public function get(): string
    {
        $list = implode(
            ', ',
            iterator_to_array(
                $this->scriptEntries($this->plugins)
            )
        );

        return '{ ' . $list . ' }';
    }

    private function scriptEntries(iterable $plugins): Generator
    {
        $utils = oxNew(Utils::class);

        foreach ($plugins as $plugin) {
            if (!$plugin->getScriptPath()) {
                continue;
            }

            yield implode(':', [
                $utils->quote($plugin->getPluginName()),
                $utils->quote($plugin->getScriptPath()),
            ]);
        }
    }
}
