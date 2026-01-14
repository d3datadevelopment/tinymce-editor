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

use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\FileException;

class BaseUrl extends AbstractOption
{
    protected string $key = 'base_url';

    public function __construct(protected Config $config)
    {
    }

    /**
     * @return string
     */
    public function get(): string
    {
        try {
            return $this->config->getActiveView()->getViewConfig()->getModuleUrl(
                'tinymce',
                ''
            );
        } catch (FileException) {
            return '';
        }
    }

    /**
     * @return bool
     */
    public function isQuoted(): bool
    {
        return true;
    }
}
