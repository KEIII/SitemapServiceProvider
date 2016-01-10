<?php namespace KEIII\SilexSitemap;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use SitemapPHP\Sitemap as SitemapGenerator;

/**
 * Provider.
 */
class SitemapServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $app)
    {
        $app['sitemap.generator'] = function (Application $app) {
            $generator = new SitemapGenerator($app['sitemap.domain']);
            $generator->setPath(rtrim($app['sitemap.path'], '/').'/');
            $generator->setFilename(isset($app['sitemap.filename']) ? $app['sitemap.filename'] : 'sitemap');

            return $generator;
        };

        $app['sitemap'] = function (Application $app) {
            return new Sitemap($app['sitemap.generator'], $app['sitemap.loc']);
        };
    }
}
