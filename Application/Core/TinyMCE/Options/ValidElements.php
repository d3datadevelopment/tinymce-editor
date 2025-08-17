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

use O3\TinyMCE\Application\Model\Constants;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;

class ValidElements extends AbstractOption
{
    protected string $key = 'valid_elements';

    public function get(): string
    {
        return implode(
            ',',
            $this->getElementsList()
        );
    }

    public function isQuoted(): bool
    {
        return true;
    }

    protected function getElementsList(): array
    {
        return [
            '*[*]',
        ];
    }

    public function requireRegistration(): bool
    {
        $service = ContainerFactory::getInstance()->getContainer()->get(ModuleSettingServiceInterface::class);
        return $service->getBoolean("blTinyMCE_allowUnsafeElements", Constants::OXID_MODULE_ID);
    }
}
