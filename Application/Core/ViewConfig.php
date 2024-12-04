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

namespace O3\TinyMCE\Application\Core;

use O3\TinyMCE\Application\Core\TinyMCE\Loader;
use OxidEsales\Eshop\Core\Registry;

class ViewConfig extends ViewConfig_parent
{
    /**
     * @return string
     */
    public function getTinyMceInitCode(): string
    {
        $config = Registry::getConfig();
        $language = Registry::getLang();

        $loader = oxNew(Loader::class, $config, $language);
        return $loader->getEditorCode();
    }

    /**
     * @return string[]
     */
    public function getTinyMceScripts(): array
    {
        $config = Registry::getConfig();
        $language = Registry::getLang();

        $loader = oxNew(Loader::class, $config, $language);
        return $loader->getScripts();
    }

    /**
     * @return string[]
     */
    public function getTinyMceIncludes(): array
    {
        $config = Registry::getConfig();
        $language = Registry::getLang();

        $loader = oxNew(Loader::class, $config, $language);
        return $loader->getIncludes();
    }
}
