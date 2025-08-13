<?php

declare(strict_types=1);

namespace O3\TinyMCE\Application\Core\TinyMCE\Options;

class AllowJavaScript extends AbstractOption
{
    protected string $key = 'extended_valid_elements';

    public function get(): string
    {
        return '"div[onclick]"';
    }
}
