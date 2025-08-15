<?php

declare(strict_types=1);

namespace O3\TinyMCE\Application\Core\TinyMCE\Options;

class ExtendedValidElements extends AbstractOption
{
    protected string $key = 'extended_valid_elements';

    public function get(): string
    {
        return implode(
            ',',
            $this->getElementsList()
        );
    }

    public function requireRegistration(): bool
    {
        return $this->loader->getShopConfig()->getConfigParam("blTinyMCE_allowjavascript") ||
            0;
    }

    public function isQuoted(): bool
    {
        return true;
    }

    protected function getElementsList(): array
    {
        return array_merge(
            $this->loader->getShopConfig()->getConfigParam("blTinyMCE_allowjavascript") ?
                $this->getJSElementsList() :
                []
        );
    }

    protected function getJSElementsList(): array
    {
        return [
            'div[onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmouseout|onmousemove|onmouseenter|onmouseleave]',
            'span[onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmouseout|onmousemove|onmouseenter|onmouseleave]',
            'a[href|target|onclick|onmouseover|onmouseout]',
            'button[type|onclick|onmousedown|onmouseup|onmouseover|onmouseout]',
            'input[type|value|name|onclick|onchange|onfocus|onblur]',
            'textarea[name|onclick|onchange|onfocus|onblur]',
            'select[name|onchange|onclick|onfocus|onblur]',
            'option[value|onclick],form[action|method|onsubmit|onreset]',
            'label[for|onclick]',
            'img[src|alt|title|onclick|onload|onerror]',
            'script[src|type|defer|async]',
            'p[onclick|onmouseover|onmouseout]',
            'section[onclick|onmouseover|onmouseout]',
            'article[onclick|onmouseover|onmouseout]'
        ];
    }
}
