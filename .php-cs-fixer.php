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

$finder = PhpCsFixer\Finder::create()
                           ->in(__DIR__);

$fileHeaderComment = <<<EOF
For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

@copyright (C) 2022 Marat Bedoev, bestlife AG
@copyright (C) 2023 O3-Shop (https://www.o3-shop.com)
@copyright (C) D3 Data Development (Inh. Thomas Dartsch)
@author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
@link      https://www.oxidmodule.com
EOF;

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        'header_comment'    => [
            'header' => $fileHeaderComment,
            'comment_type' => 'PHPDoc',
            'location' => 'after_open'
        ],
        '@PHP80Migration' => true,
        '@PSR12' => true
    ])
    ->setFinder($finder);