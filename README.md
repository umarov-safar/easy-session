# Easy php session package for small project 

## Usage:
- [Methods](#methods)
- [Examples](#examples)

### Installation
```
composer require easy-session/easy-session
```


### Methods:
1. Get instance of session

```php
require_once './vendor/autoload.php';

use Easy\EasySession\Session;

$session = Session::getInstance();
```

2. Start session 

```php
$session->start();
```

3. Set value by key
```php
$session->set('key', 'values');
```

4. Get values from session by key
```php
$session->get('key');
```

4.1 Get default value if key does not exists
```php
$default = $session->get('not_existing_key', 'default value');
```

5. Get all items
```php
$session->all();
```

6. Get item and remove it
```php
$session->remove('key');
```

7. Free(clear) all session variables
```php
$session->clear();
```

7. Clear all and destory session
```php
$session->destroy();
```

8. Get session id
```php
$session->getId();
```
9. Set from existing key
```php
$session->setFromExistingKey('new_key', 'exis_key');
```

### Examples
1. Start session and set, get, remove velue
```php
require_once './vendor/autoload.php';

use Easy\EasySession\Session;

$session = Session::getInstance();

$session->start(); // Start session

$session->set('user', ['name' => 'Ali', 'email' => 'test@gmail']); // setting data to session

$user = $session->get('user'); // getting user from sesion

echo '<pre>';
print_r($user);
// output: Array([name] => Ali [email] => test@gmail)

// not existing key
print_r($session->get('test')) 
//output: NULL

// default value
print_r($session->get('test', 'default value'))
//output: default value

//Remove item from session
$session->remove('user');

// get item and remove it
$user = $session->get('user'); 
```

2. Free all session variables and destroy
```php
require_once './vendor/autoload.php';

use Easy\EasySession\Session;

$session = Session::getInstance();

$session->start(); // Start session

$session->set('user', ['name' => 'Ali', 'email' => 'test@gmail']); // setting data to session

$session->set('cart', ['product 1', 'product 2']);

echo count($this->all()); 
// output: 2

$session->isEmpty(); // return false session not empty

$session->clear(); // clear all session variables

$session->isEmpty(); // return true 

// to destroy session 
$session->destroy();
```

### Enjoy it