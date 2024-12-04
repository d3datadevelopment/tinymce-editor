<?php

/**
 * This file is part of O3-Shop TinyMCE editor module.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with O3-Shop.  If not, see <http://www.gnu.org/licenses/>
 *
 * @copyright  Copyright (c) 2022 Marat Bedoev, bestlife AG
 * @copyright  Copyright (c) 2023 O3-Shop (https://www.o3-shop.com)
 * @license    https://www.gnu.org/licenses/gpl-3.0  GNU General Public License 3 (GPLv3)
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
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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
        } catch (ContainerExceptionInterface|NotFoundExceptionInterface) {
            return false;
        }
    }
}
