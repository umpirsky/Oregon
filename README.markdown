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
