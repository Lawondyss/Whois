Whois
=====
Library for get whois information about domain.

Uses the API from the site [sudostuff.com]. About the API is available on this [article].

License
-------
Is freely distributable under the terms of the [GPL-3] license.


Install
-------
Whois is available on [Packagist], where you can get it via [Composer].

File **composer.json**:
```json
{
    "require": {
        "lawondyss/whois": "dev-master"
    }
}
```

Run in command-line:
```sh
php composer.phar install
```

Uses
----
```php
$whois = new Whois\Whois;

$info = $whois->getInfo('google.com');

var_dump($info['Domain Name']); // string(10) "google.com"
var_dump($info['Creation Date']); // string(13) "2002-10-02T00"
var_dump($info['Admin Organization']); // string(11) "Google Inc."
```


[sudostuff.com]:http://www.sudostuff.com
[article]:http://www.sudostuff.com/free-open-source-whois-api-1.html
[GPL-3]:https://tldrlegal.com/license/gnu-general-public-license-v3-(gpl-3)
[Packagist]:https://packagist.org/packages/lawondyss/moment-php
[Composer]:http://getcomposer.org/