# Easy php session package for small project 

## Usage:
- [Methods](#methods)
- [Examples](#examples)
- [Session Interface](#session-interface)
- [Tests](#tests)

### Installation
```
composer require easy-session/easy-session
```


### Methods:
1. Create instance of session class

```php
require_once './vendor/autoload.php';

use Easy\EasySession\Session;

$session = new Session();
```

2. Start session 

```php
$session->start();
```

3. Set value to session by key
```php
$session->set('key', 'values');
```

4. Get values from session by key
```php
$session->get('key');
```

4.1 Get default value if key does not exists in session
```php
$default = $session->get('not_existing_key', 'default value');
```

5. Get all items
```php
$session->all();
```

6. Remove item by key
```php
$session->remove('key');
```

7. Free(clear) all session variables(keys,items)
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
1. Start session, set, get and remove methods
```php
require_once './vendor/autoload.php';

use Easy\EasySession\Session;

$session = new Session();

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
print_r($session->get('test', 'if key doesnt exists return this'))
//output: if key doesnt exists return this


//Remove item from session
$session->remove('user');

$user = $session->get('user'); // getting user from sesion after removing it

echo '<pre>';
print_r($user);
// output: NULL
```

2. Free all session variables and destroy
```php
require_once './vendor/autoload.php';

use Easy\EasySession\Session;

$session = new Session();

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

### Session interface
```php
interface SessionInterface
{
    public function has(string $key): bool;

    public function getId(): string;

    public function all(): array;

    public function get(string $key): mixed;

    public function set(string $key, mixed $value);

    public function clear() : void;

    public function remove(string $key) : void;

    public function setFromExistingKey($newKey, $fromKey): bool;

    public function destroy(): void;

    public function isEmpty(): bool;
}
```


### Tests
All methods covered by test
