# SitemapServiceProvider for Silex

[![Build Status](https://travis-ci.org/KEIII/SitemapServiceProvider.svg?branch=1.x)](https://travis-ci.org/KEIII/SitemapServiceProvider)

Provides [sitemap-php](https://github.com/evert/sitemap-php) service for Silex microframework.

## Installation
```bash
composer require keiii/silex-sitemap
```

## How to use
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

$app = new \Silex\Application();
$app->register(new \KEIII\SilexSitemap\SitemapServiceProvider(), array(
    'sitemap.domain' => 'http://example.com',
    'sitemap.path' => __DIR__,
    'sitemap.loc' => 'http://example.com/',
));

/** @var \KEIII\SilexSitemap\Sitemap $sitemap */
$sitemap = $app['sitemap'];

for ($i = 0; $i < 51000; $i++) {
    $item = new \KEIII\SilexSitemap\SitemapItem();
    $item->setLoc('/');
    $item->setPriority(1.0);
    $item->setChangefreq('daily');
    $item->setLastmod(new \DateTime());
    $sitemap->addItem($item);
}

$sitemap->create();
```

When you run your script, it generates and saves XML files to given path.
