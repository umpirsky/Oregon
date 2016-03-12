<h3 align="center">
    <a href="https://github.com/umpirsky">
        <img src="https://farm2.staticflickr.com/1709/25098526884_ae4d50465f_o_d.png" />
    </a>
</h3>
<p align="center">
  <a href="https://github.com/umpirsky/Symfony-Upgrade-Fixer">symfony upgrade fixer</a> &bull;
  <a href="https://github.com/umpirsky/Twig-Gettext-Extractor">twig gettext extractor</a> &bull;
  <a href="https://github.com/umpirsky/wisdom">wisdom</a> &bull;
  <a href="https://github.com/umpirsky/centipede">centipede</a> &bull;
  <a href="https://github.com/umpirsky/PermissionsHandler">permissions handler</a> &bull;
  <a href="https://github.com/umpirsky/Extraload">extraload</a> &bull;
  <a href="https://github.com/umpirsky/Gravatar">gravatar</a> &bull;
  <a href="https://github.com/umpirsky/locurro">locurro</a> &bull;
  <a href="https://github.com/umpirsky/country-list">country list</a> &bull;
  <a href="https://github.com/umpirsky/Transliterator">transliterator</a>
</p>

# Oregon [![Build Status](https://travis-ci.org/umpirsky/Oregon.png?branch=master)](https://travis-ci.org/umpirsky/Oregon)

Statistics library for open source organizations.

It can fetch and aggregate various information about organization from [GitHub](https://github.com) and [Packagist](https://packagist.org/).

## Usage

Get contributors:

```php
<?php

(new Oregon\Oregon('Sylius'))->getContributors();
```

This will merge GitHub contributors for all repositories in Sylius organization sorted by number of contributions.

Get downlod count:

```php
<?php

(new Oregon\Oregon('Sylius'))->getDownloads();
```

This will sum download count for all packages from Sylius vendor fetched from Packagist.

See [more examples](https://github.com/umpirsky/Oregon/tree/master/examples).

## Installation

The recommended way to install Oregon is through composer:

```js
{
    "require": {
        "umpirsky/oregon": "0.1.*"
    }
}
```
