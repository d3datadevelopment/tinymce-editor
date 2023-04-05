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
 * @copyright  Copyright (c) 2022 OXID Marat Bedoev, bestlife AG
 * @copyright  Copyright (c) 2023 O3-Shop (https://www.o3-shop.com)
 * @license    https://www.gnu.org/licenses/gpl-3.0  GNU General Public License 3 (GPLv3)
 */

declare(strict_types=1);

namespace O3\TinyMCE\Application\Core\TinyMCE\Options;

class Protect extends AbstractOption
{
    protected string $key = 'protect';

    public function get(): string
    {
        $protect = [
            '/\[\{((?!\}\]).)+\}\]/gm', // Allow Smarty codes [{foobar}]
            '/\{\{(.*)\}\}/gm', // Allow Twig output codes  {{foobar}}
            '/\{\%(.*)\%\}/gm', // Allow TWIG control codes  {%foobar%}
            '/\{\#(.*)\#\}/gm', // Allow TWIG comment codes  {#foobar#}
        ];

        return '[ '.implode(', ', $protect).' ]';
    }
}