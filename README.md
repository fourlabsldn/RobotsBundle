# Robots Bundle

**Symfony2 bundle to control `X-Robots-Tag` HTTP header via annotations.**

[![Total Downloads](https://poser.pugx.org/fourlabs/robots-bundle/downloads)](https://packagist.org/packages/fourlabs/robots-bundle)
[![License](https://poser.pugx.org/fourlabs/robots-bundle/license)](https://packagist.org/packages/fourlabs/robots-bundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/25fe368d-13ac-4e1b-8de0-82575b2b7d3a/mini.png)](https://insight.sensiolabs.com/projects/25fe368d-13ac-4e1b-8de0-82575b2b7d3a)

## Installation
### Download the Bundle
Open a command console, enter your project directory and execute the following command to download the latest version of this bundle:

``` bash
$ composer require fourlabs/robots-bundle dev-master
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Enable the Bundle

Then, enable the bundle by adding the following line in the *app/AppKernel.php* file of your project:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FourLabs\RobotsBundle\FourLabsRobotsBundle(),
    );
}
```

## Usage

For more details see: https://developers.google.com/webmasters/control-crawl-index/docs/robots_meta_tag#using-the-x-robots-tag-http-header

Examples:

``` php
use FourLabs\RobotsBundle\Configuration\Robots;

/**
 * @Robots(directive="index")
 */
public function showAction()
{
}
```

``` php
use FourLabs\RobotsBundle\Configuration\Robots;

/**
 * @Robots(directive="nofollow", userAgent="googlebot")
 * @Robots(directive="noindex, nofollow" userAgent="otherbot")
 */
public function showAction()
{
}
```

``` php
use FourLabs\RobotsBundle\Configuration\Robots;

/**
 * @Robots(directive="noarchive")
 * @Robots(directive="unavailable_after" value="25 Jun 2010 15:00:00 PST")
 */
public function showAction()
{
}
```

### Configuration

Set `block_all` to true to always set the `X-Robots-Tag` header to `none`. This will block all indexing and serving. Default: false

This is helpful to set an **environment specific robots header** so as to prevent search engines from indexing dev and test environments. Simple place the following configuration in your config_dev.yml and/or config_test.yml.

``` yaml
four_labs_robots:
    block_all: true
```
