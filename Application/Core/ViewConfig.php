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
use O3\TinyMCE\Application\Core\TinyMCE\LoaderInterface;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ViewConfig extends ViewConfig_parent
{
    /**
     * @return string
     */
    public function getTinyMceInitCode(): string
    {
        return $this->getTinyMceLoader()->getEditorCode();
    }

    /**
     * @return string[]
     */
    public function getTinyMceScripts(): array
    {
        return $this->getTinyMceLoader()->getScripts();
    }

    /**
     * @return string[]
     */
    public function getTinyMceIncludes(): array
    {
        return $this->getTinyMceLoader()->getIncludes();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getTinyMceLoader(): Loader
    {
        return ContainerFactory::getInstance()->getContainer()->get(LoaderInterface::class);
    }
}
