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

// @codeCoverageIgnoreStart
declare(strict_types=1);

return [
    'charset'                                => 'UTF-8',
    'TINYMCE_TOGGLE'                         => 'toggle editor',
    'TINYMCE_PLAINCMS'                       => '<b class="errorbox">The editor was disabled for this page because it may not contain HTML code</b>',
    'SHOP_MODULE_GROUP_tinyMceMain'          => '<style>.groupExp dl dd li {margin-left: 300px;} .groupExp dd h3 {border-bottom: none; margin-bottom: 0;} .groupExp dt .txtfield {margin-top: 33px;}</style>module settings',
    'SHOP_MODULE_blTinyMCE_filemanager'      => 'enable filemanager',
    'HELP_SHOP_MODULE_blTinyMCE_filemanager' => 'When enabled, you can upload pictures into this directory: out/pictures/wysiwigpro/',
    'SHOP_MODULE_aTinyMCE_classes'           => '<h3>Enable TinyMCE for following backend pages:</h3><ul><li>article_main (product details)</li><li>content_main (CMS pages)</li><li>category_text (category description)</li><li>newsletter_main (newsletter)</li><li>news_text (news text)</li></ul>',
    'HELP_SHOP_MODULE_aTinyMCE_classes'      => 'if you want to use TinyMCE for your custom controllers, you need to enter their class names here.',
    'SHOP_MODULE_GROUP_tinyMceSettings'      => 'TinyMCE Settings &amp; Plugins',
    'SHOP_MODULE_GROUP_tinyMceAdvanced'      => '<style>.groupExp dl dd li {margin-left: 300px;} .groupExp dd h3 {border-bottom: none; margin-bottom: 0;} .groupExp dt .txtfield {margin-top: 33px;}</style>advanced settings',
    'SHOP_MODULE_blTinyMCE_allowUnsafeElements'  => 'allow unsafe HTML elements and its attributes',
    'HELP_SHOP_MODULE_blTinyMCE_allowUnsafeElements'  => <<<HTML
        disables the editor's own element filter.<br>
Unsecure elements can allow malicious code on your page, so use this option with caution!
HTML,
];
// @codeCoverageIgnoreEnd
