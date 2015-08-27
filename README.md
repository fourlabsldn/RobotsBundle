# Robots Bundle
Symfony2 bundle to control X-Robots-Tag HTTP header via annotations.

[![Total Downloads](https://poser.pugx.org/fourlabs/robots-bundle/downloads)](https://packagist.org/packages/fourlabs/robots-bundle)
[![License](https://poser.pugx.org/fourlabs/robots-bundle/license)](https://packagist.org/packages/fourlabs/robots-bundle)

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

### Usage

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
