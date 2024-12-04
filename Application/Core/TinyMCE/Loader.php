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

namespace O3\TinyMCE\Application\Core\TinyMCE;

use O3\TinyMCE\Application\Model\Constants;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Language;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Loader
{
    protected Config $config;
    protected Language $language;
    protected Configuration $configuration;

    public function __construct(Config $config, Language $language)
    {
        $this->config = $config;
        $this->language = $language;

        $this->configuration = oxNew( Configuration::class, $this );
        $this->configuration->build();
    }

    /**
     * @return string
     */
    public function getEditorCode(): string
    {
        if (!$this->isEnabledForCurrentController()) {
            return '';
        }

        if ($this->contentIsPlain()) {
            /** @var string $message */
            $message = $this->language->translateString('TINYMCE_PLAINCMS');
            return $message;
        }

        try {
            $engine = $this->getTemplateRenderer()->getTemplateEngine();
            return $engine->render( '@' . Constants::OXID_MODULE_ID . '/admin/editorswitch' );
        } catch ( NotFoundExceptionInterface|ContainerExceptionInterface) {
            return '';
        }
    }

    /**
     * @return bool
     */
    protected function isEnabledForCurrentController(): bool
    {
        try {
            /** @var ModuleSettingService $service */
            $service = ContainerFactory::getInstance()->getContainer()->get( ModuleSettingServiceInterface::class );
            /** @var string[] $aEnabledClasses */
            $aEnabledClasses = $service->getCollection( "aTinyMCE_classes", Constants::OXID_MODULE_ID );

            return in_array( $this->getShopConfig()->getActiveView()->getClassKey(), $aEnabledClasses );
        } catch (ContainerExceptionInterface|NotFoundExceptionInterface) {
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function contentIsPlain(): bool
    {
        // D3 disabled, because isPlain method doesn't exist in OXID eShop
        return false;
        
        //        /** @var BaseModel|Content $oEditObject */
        //        $oEditObject = $this->getShopConfig()->getActiveView()->getViewDataElement("edit");
        //        return $oEditObject instanceof Content && $oEditObject->isPlain();
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return Config
     */
    public function getShopConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return array
     */
    public function getScripts(): array
    {
        if (!$this->isEnabledForCurrentController()) {
            return [];
        }

        $sCopyLongDescFromTinyMCE = file_get_contents(__DIR__.'/../../../assets/out/scripts/copyLongDesc.js');
        $sUrlConverter = file_get_contents(__DIR__.'/../../../assets/out/scripts/urlConverter.js');
        $sInit = str_replace(
            "'CONFIG':'VALUES'",
            $this->configuration->getConfig(),
            (string) file_get_contents(__DIR__.'/../../../assets/out/scripts/init.js')
        );

        return [
            $sCopyLongDescFromTinyMCE,
            $sUrlConverter,
            $sInit
        ];
    }

    /**
     * @return array
     */
    public function getIncludes(): array
    {
        if (!$this->isEnabledForCurrentController()) {
            return [];
        }

        try {
            return [
                Registry::getConfig()->getActiveView()->getViewConfig()->getModuleUrl(
                    Constants::OXID_MODULE_ID,
                    'out/tinymce/tinymce.min.js'
                )
            ];
        } catch (FileException) {
            return [];
        }
    }

    /**
     * @return TemplateRenderer
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getTemplateRenderer(): TemplateRenderer
    {
        return ContainerFactory::getInstance()->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();
    }
}
