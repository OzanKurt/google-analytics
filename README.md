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

Add analytics scope to your scopes array to the configurations in `ozankurt/google-core` package.

```php
'scopes' => [
	'https://www.googleapis.com/auth/analytics.readonly',
],
```

## Usage (Laravel)

#### Step 1

Add `analyticsViewId` to your `config/google.php`.

```php
return [

    /**
     * View ID can be found in `http://google.com/analytics` under the `Admin` tab on navigation.
     *
     * Select `Account`, `Property` and `View`. You will see a `View Settings` link.
     */
    'analytics' => [
        'analyticsViewId' => 'ga:12345678',
    ],

];
```

#### Controller Example

```php
use Kurt\Google\Analytics as GoogleAnalytics;

class GoogleController extends Controller
{
    private $ga;

    function __construct(GoogleAnalytics $ga) {
        $this->ga = $ga;
    }

    public function index()
    {
        $results = $this->ga->getUsersAndPageviewsOverTime()->parseResults();

        var_dump($results);
    }
}
```

## Usage (Pure PHP)

#### Example

```
<?php

require 'vendor/autoload.php';

use Kurt\Google\Core;
use Kurt\Google\Analytics;

$googleCore = new Core([
    'applicationName'       => 'MyProject',
    'p12FilePath'           => 'MyProject-1b6e6bbb8826.p12',
    'serviceClientId'       => '122654635465-u7io2injkjniweklew48knh7158.apps.googleusercontent.com',
    'serviceAccountName'    => '122654635465-u7io2injkjniweklew48knh7158@developer.gserviceaccount.com',
    'scopes' => [
        'https://www.googleapis.com/auth/analytics.readonly',
    ],
    'analyticsViewId'       => 'ga:97783314',
]);

$analytics = new Analytics($googleCore);

$results = $analytics->getUsersAndPageviewsOverTime()->parseResults();

var_dump($results);
```

### Results

Both of these examples will give a result like this.

The result of `GoogleController@index` should look like this:

```
array (size=2)
    'cols' => 
        array (size=2)
            0 => string 'ga:sessions' (length=11)
            1 => string 'ga:pageviews' (length=12)
    'rows' => 
        array (size=1)
            0 => array (size=2)
                'ga:sessions' => string '100' (length=3)
                'ga:pageviews' => string '250' (length=3)
```

## License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced 
software licensed under the [MIT license](http://opensource.org/licenses/MIT).
