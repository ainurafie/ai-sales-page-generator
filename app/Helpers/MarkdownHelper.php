<?php

namespace App\Helpers;

use League\CommonMark\GithubFlavoredMarkdownConverter;

class MarkdownHelper
{
    public static function toHtml(string $markdown): string
    {
        $converter = new GithubFlavoredMarkdownConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);

        return (string) $converter->convert($markdown);
    }
}
