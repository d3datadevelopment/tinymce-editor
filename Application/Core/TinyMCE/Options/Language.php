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

use OxidEsales\Eshop\Core\Language as OxidLanguage;
use OxidEsales\EshopCommunity\Core\Exception\LanguageNotFoundException;

class Language extends AbstractOption
{
    protected string $key = 'language';

    public function __construct(protected OxidLanguage $language)
    {
    }

    /**
     * @return string
     */
    public function get(): string
    {
        // https://www.tiny.cloud/docs/configure/localization/#language

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

            return $aLang[ $this->language->getLanguageAbbr((int) $this->language->getTplLanguage()) ] ?? "en";
        } catch (LanguageNotFoundException) {
            return "en";
        }
    }

    public function isQuoted(): bool
    {
        return true;
    }
}
