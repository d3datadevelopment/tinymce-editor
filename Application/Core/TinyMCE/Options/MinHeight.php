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

class MinHeight extends AbstractOption
{
    protected string $key = 'min_height';

    public function get(): string
    {
        $profile = (array) Registry::getSession()->getVariable('profile');

        if (array_key_exists(1, $profile)) {
            return (string) max(
                $profile[1] * 20,
                450
            );
        }

        return "450";
    }
}
