<?php

namespace Zenstruck\Browser\Response;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\VarDumper\VarDumper;
use Zenstruck\Browser\Response;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class HtmlResponse extends Response
{
    public function crawler(): Crawler
    {
        $crawler = new Crawler();
        $crawler->addHtmlContent($this->body());

        return $crawler;
    }

    /**
     * @internal
     */
    final public function dump(?string $selector = null): void
    {
        if (null === $selector) {
            parent::dump();

            return;
        }

        $elements = $this->crawler()->filter($selector);

        if (0 === $elements->count()) {
            throw new \RuntimeException("Element \"{$selector}\" not found.");
        }

        $elements->each(function(Crawler $node) {
            VarDumper::dump($node->html());
        });
    }
}
