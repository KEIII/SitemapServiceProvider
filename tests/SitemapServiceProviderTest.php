<?php

use Silex\Application;

/**
 * Test SitemapServiceProvider
 */
class SitemapServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $dir = __DIR__.'/sitemap';
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $app = new Application();
        $app->register(new \KEIII\SilexSitemap\SitemapServiceProvider(), array(
            'sitemap.domain' => 'http://example.com',
            'sitemap.path' => $dir,
            'sitemap.loc' => 'http://example.com/',
        ));
        /** @var \KEIII\SilexSitemap\Sitemap $sitemap */
        $sitemap = $app['sitemap'];
        $item = new \KEIII\SilexSitemap\SitemapItem();
        $item
            ->setLoc('/')
            ->setPriority(1.0)
            ->setChangefreq('daily')
            ->setLastmod(DateTime::createFromFormat('Y-m-d', '2016-01-02', new DateTimeZone('UTC')))
        ;
        $sitemap->addItem($item);
        $sitemap->create();

        $expected = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
 <url>
  <loc>http://example.com/</loc>
  <priority>1</priority>
  <changefreq>daily</changefreq>
  <lastmod>2016-01-02</lastmod>
 </url>
</urlset>
EOT;
        $actual = trim((string)file_get_contents($dir.'/sitemap.xml'));
        exec(sprintf('rm -rf %s', $dir));

        self::assertEquals($expected, $actual);
    }
}
