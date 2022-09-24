<?php

require './vendor/autoload.php';

use Easy\Session\Session;

$session = new Session();

$session->start();

$session->set('cart', ['product 1', 'product 2']);

dump($session->all('cart'));

$session->destroy();

dump($session->isStarted());

dump($session->all('cart'));
