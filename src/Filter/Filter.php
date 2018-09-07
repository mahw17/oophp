<?php

namespace Mahw17\Filter;

use \Michelf\MarkdownExtra;

/**
 * Filter and format text content.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 */
class Filter
{

    /**
     * @var array $filters Supported filters with method names of
     *                     their respective handler.
     */
    private $filters = [
        "bbcode"    => "bbcode2html",
        "link"      => "makeClickable",
        "markdown"  => "markdown",
        "nl2br"     => "nl2br",
    ];



    /**
     * Call each filter on the text and return the processed text.
     *
     * @param string $text   The text to filter.
     * @param array  $filter Array of filters to use.
     *
     * @return string with the formatted text.
     */
    public function parse($text, $filter)
    {
        foreach ($filter as $filt) {
            if (array_key_exists($filt, $this->filters)) {
                $func = $this->filters[$filt];
                $text = $this->$func($text);
            }
        }
        return $text;
    }



    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string $text The text to be converted.
     *
     * @return string the formatted text.
     */
    public function bbcode2html($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }



    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text the text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";
            },
            $text
        );
    }


    /**
     * Helper, Markdown formatting converting to HTML.
     *
     * @param string text The text to be converted.
     *
     * @return string the formatted text.
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function markdown($text)
    {
        return MarkdownExtra::defaultTransform($text);
    }



    /**
     * For convenience access to nl2br formatting of text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function nl2br($text)
    {
        return nl2br($text);
    }
}
