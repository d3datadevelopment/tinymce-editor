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

        $this->configuration = oxNew(Configuration::class, $this);
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
            return $engine->render('@' . Constants::OXID_MODULE_ID . '/admin/editorswitch');
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
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
            $service = ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
            /** @var string[] $aEnabledClasses */
            $aEnabledClasses = $service->getCollection("aTinyMCE_classes", Constants::OXID_MODULE_ID);

            return in_array($this->getShopConfig()->getActiveView()->getClassKey(), $aEnabledClasses);
        } catch (ContainerExceptionInterface|NotFoundExceptionInterface) {
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function contentIsPlain(): bool
    {
        /** @var BaseModel|Content $oEditObject */
        $oEditObject = $this->getShopConfig()->getActiveView()->getViewDataElement("edit");

        return is_object($oEditObject) &&
               method_exists($oEditObject, 'isPlain') &&
               $oEditObject->isPlain();
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
     * @return string[]
     */
    public function getScripts(): array
    {
        if (!$this->isEnabledForCurrentController()) {
            return [];
        }

        $sCopyLongDescFromTinyMCE = file_get_contents(__DIR__.'/../../../assets/out/scripts/copyLongDesc.js') ?: '';
        $sUrlConverter = file_get_contents(__DIR__.'/../../../assets/out/scripts/urlConverter.js') ?: '';
        $sInit = str_replace(
            "'CONFIG':'VALUES'",
            $this->configuration->getConfig(),
            (string) file_get_contents(__DIR__.'/../../../assets/out/scripts/init.js')
        );

        return [
            $sCopyLongDescFromTinyMCE,
            $sUrlConverter,
            $sInit,
        ];
    }

    /**
     * @return string[]
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
                ),
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
