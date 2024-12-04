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

function checkAccess(string $action): void
{
    unset($action);
    if ($_COOKIE['filemanagerkey'] !== md5_file(__DIR__."/../../../../../../../source/config.inc.php")) {
        header("HTTP/1.1 401 Unauthorized");
        die();
    }
}
