<?php namespace KEIII\SilexSitemap;

use SitemapPHP\Sitemap as SitemapGenerator;

class Sitemap
{
    /**
     * @var SitemapGenerator
     */
    private $generator;

    /**
     * Accessible URL path of sitemaps.
     * @var string
     */
    private $loc;

    /**
     * Constructor.
     * @param SitemapGenerator $generator
     * @param $loc
     */
    public function __construct(SitemapGenerator $generator, $loc)
    {
        $this->generator = $generator;
        $this->loc = (string)$loc;
    }

    /**
     * @param SitemapItem $item
     * @return Sitemap
     */
    public function addItem(SitemapItem $item)
    {
        $this->generator->addItem(
            $item->getLoc(),
            $item->getPriority(),
            $item->getChangefreq(),
            $item->getLastmod()
        );

        return $this;
    }

    /**
     * Create sitemap.
     */
    public function create()
    {
        $this->generator->createSitemapIndex($this->loc);
    }
}
