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

use O3\TinyMCE\Application\Core\TinyMCE\Options\OptionInterface;
use OxidEsales\Eshop\Core\Registry;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class Configuration
{
    /** @var array<String, String> */
    protected array $optionList = [];

    /**
     * @param iterable<OptionInterface> $options
     */
    public function __construct(
        #[TaggedIterator('d3tinymce.option')]
        protected iterable $options
    )
    {
        foreach ($options as $option) {
            $this->addOption($option);
        }
    }

    protected function addOption(OptionInterface $optionInstance): void
    {
        if (!$optionInstance->requireRegistration()) {
            return;
        }

        $option = $optionInstance->get();

        if ($optionInstance->isQuoted()) {
            $option = (oxNew(Utils::class))->quote($option);
        }

        $this->optionList[$optionInstance->getKey()] = $option;
    }

    /**
     * @param string $optionKey
     * @return void
     */
    protected function removeOption(string $optionKey): void
    {
        if (isset($this->optionList[$optionKey])) {
            unset($this->optionList[$optionKey]);
        }
    }

    public function getConfig(): string
    {
        $sConfig = '';

        /**
         * @var string $param
         * @var string $value
         */
        foreach ($this->optionList as $param => $value) {
            $sConfig .= "$param: $value, ";
        }

        Registry::getLogger()->debug('TinyMCE configuration', [$sConfig]);

        return $sConfig;
    }
}
