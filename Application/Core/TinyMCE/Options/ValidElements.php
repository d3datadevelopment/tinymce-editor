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
 * @copyright  Copyright (c) 2025 D3 Data Development (Inh. Thomas Dartsch) (https://www.d3data.de)
 * @license    https://www.gnu.org/licenses/gpl-3.0  GNU General Public License 3 (GPLv3)
 */

declare(strict_types=1);

namespace O3\TinyMCE\Application\Core\TinyMCE\Options;

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
            '*[*]'
        ];
    }

    public function requireRegistration(): bool
    {
        return (bool) $this->loader->getShopConfig()->getConfigParam("blTinyMCE_allowUnsafeElements");
    }
}
