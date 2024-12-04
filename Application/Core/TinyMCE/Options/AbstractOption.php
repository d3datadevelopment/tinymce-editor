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

use O3\TinyMCE\Application\Core\TinyMCE\Loader;

abstract class AbstractOption implements OptionInterface
{
    protected string $key = 'undefinedKey';

    protected Loader $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    abstract public function get(): string;

    public function isQuoted(): bool
    {
        return false;
    }

    public function requireRegistration(): bool
    {
        return true;
    }
}
