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
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class Plugins extends AbstractOption
{
    protected string $key = 'plugins';

    /**
     * @param PluginInterface[] $plugins
     */
    public function __construct(
        #[TaggedIterator('d3tinymce.plugin')]
        protected iterable $plugins
    ) {
    }

    public function get(): string
    {
        $pluginList = $this->plugins;

        $names = (function () use ($pluginList) {
            foreach ($pluginList as $plugin) {
                if ($plugin->requireRegistration()) {
                    yield $plugin->getPluginName();
                }
            }
        })();

        return implode(' ', iterator_to_array($names));
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
