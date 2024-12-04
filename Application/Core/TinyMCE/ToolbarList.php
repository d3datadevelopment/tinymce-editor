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

use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Align;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Blockquote;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Color;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Font;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Blocks;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Indent;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\Lists;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\RemoveFormat;
use O3\TinyMCE\Application\Core\TinyMCE\Toolbar\ToolbarInterface;

class ToolbarList
{
    /**
     * @return array<int, array<string, ToolbarInterface>>
     */
    public function get(): array
    {
        return [
            [
                'blocks'        => oxNew(Blocks::class),
                'font'          => oxNew(Font::class),
                'color'         => oxNew(Color::class),
                'align'         => oxNew(Align::class),
                //'subscript'     => oxNew(Subscript::class),
                //'superscript'   => oxNew(Superscript::class),
            ],
            [
                //'undo'          => oxNew(Undo::class),
                //'copypaste'     => oxNew(CopyPaste::class),
                'lists'         => oxNew(Lists::class),
                'indent'        => oxNew(Indent::class),
                'blockquote'    => oxNew(Blockquote::class),
                'removeformat'  => oxNew(RemoveFormat::class),
            ],
        ];
    }
}
