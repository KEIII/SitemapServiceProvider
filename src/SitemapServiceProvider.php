<?php namespace KEIII\SilexSitemap;

use Silex\Application;
use Silex\ServiceProviderInterface;
use SitemapPHP\Sitemap as SitemapGenerator;

/**
 * Provider.
 */
class SitemapServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app['sitemap.generator'] = $app->share(function (Application $app) {
            $generator = new SitemapGenerator($app['sitemap.domain']);
            $generator->setPath(rtrim($app['sitemap.path'], '/').'/');
            $generator->setFilename(isset($app['sitemap.filename']) ? $app['sitemap.filename'] : 'sitemap');

            return $generator;
        });

        $app['sitemap'] = $app->share(function (Application $app) {
            return new Sitemap($app['sitemap.generator'], $app['sitemap.loc']);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
        // required by interface
    }
}
