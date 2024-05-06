
# serphouse-php

![Packagist License](https://img.shields.io/packagist/l/SERPHouse/serphouse-php)
![Packagist Downloads](https://img.shields.io/packagist/dt/SERPHouse/serphouse-php)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/SERPHouse/serphouse-php/run-tests.yml?logo=githubactions&label=Tests%20with%20PHPUnit)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/SERPHouse/serphouse-php/phpstan.yml?logo=githubactions&label=PHPStan)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/SERPHouse/serphouse-php/fix-php-code-style-issues.yml?logo=githubactions&label=Code%20Quality)

SERPHouse API is the starting point on your journey towards building a powerful SEO software. With SERPHouse you can get all the data you’d need to build an efficient application while also saving your time and your budget.

This comprehensive document designed to provide you with all the technical information as well as product information you need to interact with our API and harness its full potential. Whether you're a software developer integrating SERPHouse SERP API services into your application or a curious user exploring the possibilities, this API documentation will serve as your go-to resource.

High Volume SERP API for SEO professionals and data scientist. We built reliable, accurate and cost efficient solution, We take cares of resolving captcha, managing proxy to ensure you get reliable Structured JSON data.

This API supported Serphouse's standard REST API that accepts/returns JSON requests. Here is the [API reference](https://docs.serphouse.com/)

## Get started

Using the Serphouse API wrapper for PHP is straightforward. Follow these steps to integrate it into your project:

## Documentation

Documentation for Serphouse's API and its usage is available at [https://docs.serphouse.com/](https://docs.serphouse.com/)

## Prerequisites

- PHP >= 7.2

## Installation

You can install the Serphouse PHP package via Composer. Run the following command in your project directory:

```bash
composer require serphouse/serphouse-php
```

## Usage

After installing the package, you can set up the Serphouse client in your code like this:

```php
<?php

use Serphouse\SERPHouseClient;

$serphouse = new SERPHouseClient('Your_API_Key_Here');
```
Replace 'Your_API_Key_Here' with your actual Serphouse API key.

## Pull Request

- Contributors can send their pull requests to the `develop` branch.
- Please ensure that test cases are validated before opening a new pull request.

## Get API Key

You can obtain an API key by registering at [https://app.serphouse.com/register](https://app.serphouse.com/register). This key will be required for accessing the API.

## Examples

1. [Serp Api](#serp-api)

2. [Domains List](#domains-list)

3. [Languages List](#language-list)

4. [Locations List](#location-list)

5. [Account Info](#account-info)

6. [Trend Api](#trend-api)

---

> ## [Serp Api](#examples)

**1. SERP Live**

    ```php
    $serphouse->serpApi->live([
        'data' => [
            'q' => 'apple',
            'domain' => 'google.com',
            'lang' => 'en',
            'device' => 'desktop',
            'serp_type' => 'web',
            'loc' => 'Alba,Texas,United States',
            'loc_id' => '1026201',
            'verbatim' => '0',
            'gfilter' => '0',
            'page' => '1',
            'num_result' => '10',
        ],
    ]);
    ```
    If you need to get response by responseType HTML or Json then you can use Like Below Example:

    ```php
    $serphouse->serpApi->live('DATA_ARRAY','responseType'); // default responseType is Json
    ```

**2. SERP Schedule**

    ```php
    $serphouse->serpApi->schedule([
        "data" => [
            [
                "q" => "Coffee",
                "domain" => "google.com",
                "lang" => "en",
                "device" => "desktop",
                "serp_type" => "web",
                "loc" => "Alba,Texas,United States",
                "verbatim" => 0,
                "postback_url" => "Webhook_url",
                "pingback_url" => "Webhook_url",
                "page" => 1,
                "num_result" => 10
            ]
        ]
    ]);
    ```

**3. SERP Check**

    ```php
    $serphouse->serpApi->check('SERP_ID');
    ```
    
**4. SERP Get**

    ```php
    $serphouse->serpApi->get('SERP_ID');
    ```

    If you need to get response by responseType HTML or Json then you can use like below example:

    ```php
    $serphouse->serpApi->get('SERP_ID','responseType'); // default responseType is Json
    ```

> ## [Domains List](#examples)

**1. Get Domains List**

    ```php
    $serphouse->domains->list();
    ```

> ## [Languages List](#examples)

**1. Get Languages List**

    ```php
    $serphouse->languages->list();
    ```

    If you need to get Languages List by google, bing and yahoo then you can use like below example:

    ```php
    $serphouse->languages->list(['type'=> 'bing']); // default type is google
    ```

> ## [Locations List](#examples)

**1. Get Locations List**

    ```php
    $serphouse->location->search(['q'=> 'texas']);
    ```

    If you need to get Locations List by google, bing and yahoo then you can use like below example:

    ```php
    $serphouse->languages->search(['q'=> 'texas','type'=> 'bing']); // default type is google
    ```

> ## [Account Info](#examples)

**1. Get Account Information**

    ```php
    $serphouse->account->fetch();
    ```

> ## [Trend Api](#examples)

**1. Trend Search**

    ```php
    $serphouse->trends->search([
        'time_zone_offset' => '-330',
        'keywords' => 'google,youtube',
        'time' => 'now 1-d',
        'property' => 'youtube',
        'category' => '0',
        'geo' => 'us',
        'language_code' => 'en'
    ]);
    ```

**2. Trend Schedule**

    ```php
    $serphouse->trends->schedule([
        "data" => [
            [
                "time_zone_offset" => -330,
                "keywords" => "google",
                "time" => "now 1-d",
                "property" => "youtube",
                "category" => 0,
                "geo" => "us",
                "language_code" => "en",
                "postback_url" => "Webhook_url",
                "pingback_url" => "Webhook_url"
            ]
        ]
    ]);
    ```

**3. Get TimeZone List**

    ```php
    $serphouse->trends->timeZoneList();
    ```

**4. Get Categories List**

    ```php
    $serphouse->trends->categoryList();
    ```

**5. Get Country and State List**

    ```php
    $serphouse->trends->countryStateList();
    ```

**6. Get Language List**

    ```php
    $serphouse->trends->languageList();
    ```

**7. Trends Check**

    ```php
    $serphouse->trends->check('TRENDS_ID');
    ```

**8. Trends Get**

    ```php
    $serphouse->trends->get('TRENDS_ID');
    ```

## Response

Example of success response.

```
SERPHouse\Services\Handlers\Responses Object
(
    [statusCode:SERPHouse\Services\Handlers\Responses:private] => 200
    [response:SERPHouse\Services\Handlers\Responses:private] => {"status":"success","msg":"Completed","search_metadata":{"id":128078258,"status":"success","created_at":"2024-05-04T06:20:10.000000Z","processed_at":"2024-05-04 06:20:10"},"search_parameters":{"langauge_code":"en-US","geo":"US","keywords":"google,youtube","time_zone_offset":"-330","time":"now 1-d","category":0,"property":"youtube"},"results":{"TIMESERIES":[{"time":"1714716960","formattedTime":"May 3, 2024 at 11:46 AM","formattedAxisTime":"May 3 at 11:46 AM","value":[19,72],"hasData":[true,true],"formattedValue":["19","72"]}],"GEO_MAP":{"google":{"default":{"geoMapData":[{"geoCode":"US-VT","geoName":"Vermont","value":[100],"formattedValue":["100"],"maxValueIndex":0,"hasData":[true]}]}},"youtube":{"default":{"geoMapData":[{"geoCode":"US-NH","geoName":"New Hampshire","value":[100],"formattedValue":["100"],"maxValueIndex":0,"hasData":[true]}]}}},"RELATED_QUERIES":{"google":{"default":{"rankedList":[{"rankedKeyword":[{"query":"google link","value":100,"formattedValue":"100","hasData":true,"link":"/trends/explore?q=google+link&date=now+1-d&geo=US"}]},{"rankedKeyword":[{"query":"the man who killed google search","value":1650,"formattedValue":"+1,650%","link":"/trends/explore?q=the+man+who+killed+google+search&date=now+1-d&geo=US"}]}]}},"youtube":{"default":{"rankedList":[{"rankedKeyword":[{"query":"on youtube","value":100,"formattedValue":"100","hasData":true,"link":"/trends/explore?q=on+youtube&date=now+1-d&geo=US"}]},{"rankedKeyword":[{"query":"jayson tatum youtube channel","value":5300,"formattedValue":"Breakout","link":"/trends/explore?q=jayson+tatum+youtube+channel&date=now+1-d&geo=US"}]}]}}}}}
    [errorMessage:SERPHouse\Services\Handlers\Responses:private] => 
)
```

Example of validation errors response.

```
SERPHouse\Services\Handlers\Responses Object
(
    [statusCode:SERPHouse\Services\Handlers\Responses:private] => 400
    [response:SERPHouse\Services\Handlers\Responses:private] => {"status":"error","msg":"validation_error","error":{"time_zone_offset":["The time zone offset field is required."]}}
    [errorMessage:SERPHouse\Services\Handlers\Responses:private] => Client error: `POST https://api.serphouse.com/trends/search` resulted in a `400 Bad Request` response:
{"status":"error","msg":"validation_error","error":{"time_zone_offset":["The time zone offset field is required."]}}
)
```

You need to manage the response.

- get response status code using `getStatusCode()` function 

    ```php
    $response->getStatusCode()
    ```

- get response using `getResponse()` function and you will get Json string

    ```php
    $response->getResponse()
    ```

- get error message using `getErrorMessage()` function and you will get Json string

    ```php
    $response->getErrorMessage()
    ```


## Exception Classes

### SERPHouseNotFoundException

This exception is thrown when the requested call is not found.

### SERPHousePaymentRequiredException

This exception is thrown when payment is required to access the requested call.

### SERPHouseRateLimitExceededException

This exception is thrown when the rate limit for API requests has been exceeded in the SERP House API. For more information about rate limit check this https://docs.serphouse.com/introduction/rate-limits  

### SERPHouseServerErrorException

This exception is thrown when there is an internal server error.

### SERPHouseUnauthorizedException

This exception is thrown when the request is unauthorized to access the requested call or Invalid API Key.
