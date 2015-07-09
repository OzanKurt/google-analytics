# Google Analytics

## Installation

### Step 1
Add `ozankurt/google-analytics` to your composer requirements.

```
composer require ozankurt/google-analytics
```

### Step 2
Configure `ozankurt/google-core` package by following its [README](https://github.com/OzanKurt/google-core/blob/master/README.md).

### Step 3

Select the Analytics API

![Select the Analytics API](http://i.imgur.com/t8RqhVN.png)

Enable it

![Enable It](http://i.imgur.com/w2B0YKB.png)

### Step 4

Add analytics scope to your scopes array in the configuration file from `ozankurt/google-core` package.

```php
'scopes' => [
	'https://www.googleapis.com/auth/analytics.readonly',
],
```

## Usage

#### Controller Example

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Kurt\Google\Analytics as GoogleAnalytics;

class GoogleController extends Controller
{
    private $ga;

    function __construct(GoogleAnalytics $ga) {
        $this->ga = $ga;
    }

    public function index()
    {
        return $this->ga->getUsersAndPageviewsOverTime()->parseResults();
    }
}
```

The result of `GoogleController@index` should look like this:

```json
{
    "cols": [
        "ga:sessions",
        "ga:pageviews"
    ],
    "rows": [
        {
            "ga:sessions": "113",
            "ga:pageviews": "159"
        }
    ]
}
```

## License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced 
software licensed under the [MIT license](http://opensource.org/licenses/MIT).
