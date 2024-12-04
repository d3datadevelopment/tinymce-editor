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
use OxidEsales\Eshop\Core\Registry;

class ContentCss extends AbstractOption
{
    protected string $key = 'content_css';

    protected Loader $loader;

    protected bool $darkMode = false;

    public function get(): string
    {
        /** @var string $theme */
        $theme = Registry::getConfig()->getConfigParam('sTheme');

        return implode(
            ',',
            [
                $this->darkMode ?
                    'dark' :
                    '/out/'.strtolower($theme).'/src/css/styles.min.css',
            ]
        );
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
