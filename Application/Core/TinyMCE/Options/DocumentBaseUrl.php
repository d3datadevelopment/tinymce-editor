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

use OxidEsales\Eshop\Core\Registry;

class DocumentBaseUrl extends AbstractOption
{
    protected string $key = 'document_base_url';

    public function get(): string
    {
        return Registry::getConfig()->getActiveView()->getViewConfig()->getBaseDir();
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
