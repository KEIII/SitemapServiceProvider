# SitemapServiceProvider for Silex

[![Build Status](https://travis-ci.org/KEIII/SitemapServiceProvider.svg?branch=master)](https://travis-ci.org/KEIII/SitemapServiceProvider)

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
    $item = (new \KEIII\SilexSitemap\SitemapItem())
        ->setLoc('/')
        ->setPriority(1.0)
        ->setChangefreq('daily')
        ->setLastmod(new \DateTime())
    ;
    $sitemap->addItem($item);
}

$sitemap->create();
```

When you run your script, it generates and saves XML files to given path.
