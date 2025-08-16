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

use OxidEsales\EshopCommunity\Core\Exception\LanguageNotFoundException;

class Language extends AbstractOption
{
    protected string $key = 'language';

    /**
     * @return string
     */
    public function get(): string
    {
        // https://www.tiny.cloud/docs/configure/localization/#language

        $oLang = $this->loader->getLanguage();

        try {
            $aLang = [
                "cs" => "cs",
                "da" => "da",
                "de" => "de",
                "es" => "es",
                "fr" => "fr_FR",
                "it" => "it",
                "nl" => "nl",
                "ru" => "ru",
            ];

            return $aLang[ $oLang->getLanguageAbbr((int) $oLang->getTplLanguage()) ] ?? "en";
        } catch (LanguageNotFoundException) {
            return "en";
        }
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
