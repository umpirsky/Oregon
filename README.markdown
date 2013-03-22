# Oregon

Statistics library for open source organizations.

## Installation

The recommended way to install Oregon is through composer:

```js
{
    "require": {
        "umpirsky/oregon": "0.1.*"
    }
}
```

## Usage

Get contributors:

```php
<?php

(new Oregon\Oregon('Sylius'))->getContributors();
```
