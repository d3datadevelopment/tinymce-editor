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
use O3\TinyMCE\Application\Model\Constants;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsServer;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use Throwable;

class FilemanagerUrl extends AbstractOption
{
    protected string $key = 'filemanager_url';

    protected Loader $loader;

    public function get(): string
    {
        $sFilemanagerKey = md5_file(
            rtrim(Registry::getConfig()->getConfigParam("sShopDir"), '/')."/config.inc.php"
        ) ?: '';
        Registry::get(UtilsServer::class)->setOxCookie("filemanagerkey", $sFilemanagerKey);

        return str_replace(
            '&amp;',
            '&',
            Registry::getConfig()->getActiveView()->getViewConfig()->getSslSelfLink()."cl=tinyfilemanager"
        );
    }

    public function isQuoted(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function requireRegistration(): bool
    {
        try {
            /** @var ModuleSettingService $service */
            $service = ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
            return $service->getBoolean("blTinyMCE_filemanager", Constants::OXID_MODULE_ID);
        } catch (Throwable) {
            return false;
        }
    }
}
