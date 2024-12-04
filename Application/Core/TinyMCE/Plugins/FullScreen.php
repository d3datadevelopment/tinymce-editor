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

namespace O3\TinyMCE\Application\Core\TinyMCE\Plugins;

use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Registry;

class FullScreen extends AbstractPlugin
{
    public function getPluginName(): string
    {
        return 'oxfullscreen';
    }

    public function getToolbarElements(): array
    {
        return [
            'fullscreen',
        ];
    }

    /**
     * @return string|null
     * @throws FileException
     */
    public function getScriptPath(): ?string
    {
        return Registry::getConfig()->getActiveView()->getViewConfig()->getModuleUrl(
            'o3-tinymce-editor',
            'out/plugins/oxfullscreen/plugin.js'
        );
    }
}
