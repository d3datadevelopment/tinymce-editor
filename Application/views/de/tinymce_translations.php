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
    'TINYMCE_TOGGLE'                         => 'Editor zeigen/verstecken',
    'TINYMCE_PLAINCMS'                       => '<b class="errorbox">Der Editor wurde für diese Seite deaktiviert, weil sie keine HTML Formatierung enthalten darf </b>',
    'SHOP_MODULE_GROUP_tinyMceMain'          => '<style>.groupExp dl dd li {margin-left: 300px;} .groupExp dd h3 {border-bottom: none; margin-bottom: 0;} .groupExp dt .txtfield {margin-top: 33px;}</style>Moduleinstellungen',
    'SHOP_MODULE_blTinyMCE_filemanager'      => 'Dateimanager aktivieren',
    'HELP_SHOP_MODULE_blTinyMCE_filemanager' => 'Ist diese Option aktiv, können Bilder hochgeladen werden. Der Speicherort ist: out/pictures/wysiwigpro/',
    'SHOP_MODULE_aTinyMCE_classes'           => '<h3>TinyMCE für folgende Backend-Seiten laden:</h3><ul><li>article_main (Artikelbeschreibung)</li><li>content_main (CMS Seiten)</li><li>category_text (Kategorienbeschreibung)</li><li>newsletter_main (Newsletter)</li><li>news_text (Nachrichten-Text)</li></ul>',
    'HELP_SHOP_MODULE_aTinyMCE_classes'      => 'für die Benutzung von TinyMCE in eigenen Admin Views muss hier die entsprechende Controllerklasse eingetragen werden, dann wird für jedes Textarea je ein Editor erzeugt',
    'SHOP_MODULE_GROUP_tinyMceSettings'      => 'TinyMCE Einstellungen &amp; Plugins',
    'SHOP_MODULE_GROUP_tinyMceAdvanced'      => '<style>.groupExp dl dd li {margin-left: 300px;} .groupExp dd h3 {border-bottom: none; margin-bottom: 0;} .groupExp dt .txtfield {margin-top: 33px;}</style>Erweiterte Einstellungen',
    'SHOP_MODULE_blTinyMCE_allowUnsafeElements'  => 'unsichere HTML Elemente und deren Attribute erlauben',
    'HELP_SHOP_MODULE_blTinyMCE_allowUnsafeElements'  => <<<HTML
                deaktiviert den Editor-eigenen Elementfilter<br>
                unsichere Elemente können Schadcode auf Ihrer Seite erlauben, aktivieren Sie die Option daher mit Bedacht!
        HTML,
];
// @codeCoverageIgnoreStart
