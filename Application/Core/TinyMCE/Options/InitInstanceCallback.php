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

use O3\TinyMCE\Application\Core\TinyMCE\Utils;

class InitInstanceCallback extends AbstractOption
{
    protected string $key = 'init_instance_callback';

    public function get(): string
    {
        // https://github.com/tinymce/tinymce/issues/2271

        $js = <<<JS
                function (editor) {
                    editor.on('PostProcess', function (e) {
                        e.content = e.content.replace(
                            /(&lt;!--mce:protected\s)(.*?)(--&gt;)/gm, 
                            function(text, p1, p2, p3){
                                if (unescape) {
                                    return unescape(p2);
                                } else {
                                    return decodeURIComponent(p2);
                                }
                            }
                        );
                    });
                }
            JS;

        return (oxNew(Utils::class))->minifyJS($js);
    }
}
