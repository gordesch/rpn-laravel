<?php

namespace App\Services;

use Wa72\HtmlPageDom\HtmlPageCrawler;

class Html
{
    protected HtmlPageCrawler $dom;

    public static function transform(string $html): string
    {
        $transformer = new self();
        $transformer->dom = new HtmlPageCrawler($html);
        $transformer
            ->parseStrongTags()
            ->parseUnderlineTags()
            ->parseEmphasisTags()
            ->parseAnchorTags()
            ->parseAlignLeftClasses()
            ->parseAlignCenterClasses()
            ->parseAlignRightClasses()
            ->parseAlignJustifyClasses();
        return $transformer->dom->saveHTML();
    }

    protected function parseStrongTags(): self
    {
        $this->dom
            ->filter('strong')
            ->wrap('<span class="font-medium">')
            ->unwrapInner();
        return $this;
    }

    protected function parseUnderlineTags(): self
    {
        $this->dom
            ->filter('u')
            ->wrap('<span class="underline">')
            ->unwrapInner();
        return $this;
    }

    protected function parseEmphasisTags(): self
    {
        $this->dom
            ->filter('em')
            ->wrap('<span class="italic">')
            ->unwrapInner();
        return $this;
    }

    protected function parseAnchorTags(): self
    {
        $this->dom
            ->filter('a')
            ->addClass('text-blue-500 hover:text-blue-800');
        return $this;
    }

    protected function parseAlignLeftClasses(): self
    {
        $this->dom
            ->filter('.ql-align-left')
            ->removeClass('ql-align-left')
            ->addClass('text-left');
        return $this;
    }

    protected function parseAlignCenterClasses(): self
    {
        $this->dom
            ->filter('.ql-align-center')
            ->removeClass('ql-align-center')
            ->addClass('text-center');
        return $this;
    }

    protected function parseAlignRightClasses(): self
    {
        $this->dom
            ->filter('.ql-align-right')
            ->removeClass('ql-align-right')
            ->addClass('text-right');
        return $this;
    }

    protected function parseAlignJustifyClasses(): self
    {
        $this->dom
            ->filter('.ql-align-justify')
            ->removeClass('ql-align-justify')
            ->addClass('text-justify');
        return $this;
    }
}
