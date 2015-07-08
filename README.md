# Google Analytics

## Installation

### Step 1
Add `ozankurt/google-analytics` to your composer requirements.

```
composer require ozankurt/google-analytics
```

### Step 2
Add the service provider to you `config/app.php`.

```php
'providers' => [
    Kurt\Google\GoogleCoreServiceProvider::class,
],
```

### Step 3
Publish the configuration file for `ozankurt/google-core` and fill the required fields.

#### Step 3.1

Create a google developer account which as actually logging in to any of your google accounts.

From this [link](https://developers.google.com/console/).

#### Step 3.2

Create a new project

![New Project](http://i.imgur.com/iedTiGQ.png)

#### Step 3.3

Select the Analytics API

![Select the Analytics API](http://i.imgur.com/t8RqhVN.png)

Enable it

![Enable It](http://i.imgur.com/w2B0YKB.png)

#### Step 3.4

Create a new Client ID, type should be `Service Account`

![Create a new Client ID](http://i.imgur.com/0Qme3d7.png)
![Service Account](http://i.imgur.com/YVb4EdC.png)

#### Step 3.5

Generate new P12 key and download it.

#### Step 3.6

Copy the P12 file to your storage directory.

#### Step 3.7

Add `https://www.googleapis.com/auth/analytics.readonly` to your scopes.

### Configuration File

```php
<?php

return [

	/**
	 * Application Name
	 *
	 * Name of your project in `https://console.developers.google.com/`.
	 */
	'applicationName' => 'MyProject',

	/**
	 * P12 File
	 *
	 * After creating a project, go to `APIs & auth` and choose `Credentials` section.
	 * 
	 * Click `Create new Client ID` and select `Service Account` choose `P12` as the `Key Type`.
	 *
	 * After downloading the `p12` file copy and paste it in the `storage` directory.
	 * 		Example:
	 * 			storage/MyProject-2a4d6aaa4413.p12
	 * 
	 */
	'p12FilePath' => 'MyProject-2a4d6aaa4413.p12',

	/**
	 * You will find this information under `Service Account` > `Client ID`
	 *
	 * 		Example:
	 * 			122654635465-u7io2injkjniweklew48knh7158.apps.googleusercontent.com
	 */
	'serviceClientId' => '',
	
	/**
	 * You will find this information under `Service Account` > `Email Address`
	 *
	 * 		Example:
	 * 			122654635465-u7io2injkjniweklew48knh7158@developer.gserviceaccount.com
	 */
	'serviceAccountName' => '',
	
	/**
	 * Here you should pass an array of needed scopes depending on what service you will be using.
	 *
	 * 		Example:
	 * 			For analytics service:
	 * 			
	 * 				'scopes' => [
	 *					'https://www.googleapis.com/auth/analytics.readonly',
	 *				],
	 */
	'scopes' => [
		//
	],

];
```

## Usage

#### Basic Controller Example

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
