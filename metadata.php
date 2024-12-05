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

use O3\TinyMCE\Application\Core\Setup\Events;
use O3\TinyMCE\Application\Model\Constants;

$sMetadataVersion = '2.1';
$aModule          = [
    'id' => Constants::OXID_MODULE_ID,
    'title' => 'TinyMCE Editor',
    'description' => 'TinyMCE integration for OXID eShop',
    'thumbnail' => 'picture.svg',
    'version' => '2.0.0',
    'author' => 'D3 Data Development, O3-Shop, Marat Bedoev',
    'url' => 'https://www.d3data.de/',
    'extend' => [
        OxidEsales\Eshop\Core\ViewConfig::class => O3\TinyMCE\Application\Core\ViewConfig::class,
    ],
    'controllers' => [
        'tinyfilemanager'   => O3\TinyMCE\Application\Controller\Admin\TinyFileManager::class,
    ],
    'templates' => [
        '@' . Constants::OXID_MODULE_ID.'/admin/filemanager.tpl'   => 'views/smarty/admin/filemanager.tpl',
        '@' . Constants::OXID_MODULE_ID.'/admin/editorswitch.tpl'      => 'views/smarty/admin/editorswitch.tpl',
    ],
    'blocks' => [
        [
            'template'  => 'bottomnaviitem.tpl',
            'block'     => 'admin_bottomnaviitem',
            'file'      => 'views/smarty/blocks/admin/bottomnaviitem_admin_bottomnaviitem.tpl',
        ],
    ],
    'settings' => [
        /* enabling tinyMCE for these classes */
        [
            'group' => 'tinyMceMain',
            'name' => 'aTinyMCE_classes',
            'type' => 'arr',
            'value' => [
                "article_main",
                "category_text",
                "content_main",
                "newsletter_main",
                "news_text",
            ],
            'position' => 0,
        ],
        [
            'group' => 'tinyMceMain',
            'name' => 'blTinyMCE_filemanager',
            'type' => 'bool',
            'value' => true,
            'position' => 2,
        ],
    ],
    'events'       => [
        'onActivate'   => Events::class.'::onActivate',
        'onDeactivate' => Events::class.'::onDeactivate',
    ],
];
