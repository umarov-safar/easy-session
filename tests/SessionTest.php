<?php

use Easy\EasySession\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    private Session $session;

    protected function setUp(): void
    {
        parent::setUp();

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        $reflection = new \ReflectionClass(Session::class);
        $instanceProperty = $reflection->getProperty('instance');
        $instanceProperty->setAccessible(true);
        $instanceProperty->setValue(null);

        $this->session = Session::getInstance();
        $this->session->start();
    }

    public function tearDown(): void
    {
        $this->session->clear();
    }

    public function test_check_if_a_session_is_not_started()
    {
        // MAKE ASSERTION
        $this->session->destroy();
        $this->assertFalse($this->session->isStarted());
    }

    public function test_check_is_session_empty_or_not()
    {
        $this->session->set('user', 'Safar');

        $this->assertFalse($this->session->isEmpty());

        $this->session->remove('user');
        $this->assertTrue($this->session->isEmpty());
    }

    public function test_a_session_can_be_started()
    {

        $session_status = $this->session->start();

        $this->assertTrue($this->session->isStarted());
        $this->assertTrue($session_status);
    }


    public function test_items_can_be_added_to_the_session()
    {
        // SETUP
        $productId1 = 1;
        $productId2 = 2;

        // DO SOMETHING
        $this->session->set('products', [
            $productId1 => ['quantity' => 11, 'name' => 'Product 1'],
            $productId2 => ['quantity' => 3, 'name' => 'Product 2']
        ]);

        //MAKE ASSERTIONS
        $this->assertSessionHasTheseKeys($_SESSION['products'], [$productId1, $productId2]);
    }


    public function test_can_check_that_an_item_exists_in_a_session()
    {
        // DO SOMETHING
        $this->session->set('user', [
            'id' => 12,
            'name' => 'Safar',
            'email' => 'test@gmail.com'
        ]);

        // MAKE ASSERTION
        $this->assertTrue($this->session->has('user'));
        $this->assertFalse($this->session->has('cart'));
    }


    public function test_can_get_the_item_from_the_session()
    {
        // SETUP
        $defaultExpected = 'not info';
        // DO SOMETHING
        $this->session->set('user', [
            'id' => 12,
            'name' => 'Safar',
            'email' => 'test@gmail.com'
        ]);

        $user = $this->session->get('user');
        $notExistingItem = $this->session->get('cart');
        $notInfo = $this->session->get('info', 'not info');

        // MAKE ASSERTION
        $this->assertSame('Safar', $user['name']);
        $this->assertNull($notExistingItem);
        $this->assertSame($defaultExpected, $notInfo);
    }


    public function test_can_remove_item_from_the_session()
    {
        // SETUP
        // DO SOMETHING
        $this->session->set('user', [
            'id' => 12,
            'name' => 'Safar',
            'email' => 'test@gmail.com'
        ]);

        $this->session->remove('user');

        //Make assertion
        $this->assertNull($this->session->get('user'));
    }


    public function test_can_clear_all_sessions()
    {
        $this->session->set("users", ['name' => "Safar"]);
        $this->session->set("cart", ['qty' => 1, 'name' => 'test']);

        $this->session->clear();

        $this->assertCount(0, $this->session->all());
    }


    public function test_can_get_all_sessionS_attributes()
    {
        $this->session->set("user", ['name' => "Safar"]);
        $this->session->set("cart", ['qty' => 1, 'name' => 'test']);

        $this->assertCount(2, $this->session->all());
        $this->assertArrayHasKey('user', $this->session->all());
    }


    public function test_check_session_id_is_setted()
    {
        $this->assertIsString($this->session->getId());
        $this->assertSame($this->session->getId(), session_id());
    }


    public function test_check_can_set_from_existion_key()
    {
        $this->session->set("user", ['name' => "Safar"]);

        $setted = $this->session->setFromExistingKey('guest', 'user');
        $this->assertTrue($setted);


        $setted = $this->session->setFromExistingKey('guest', 'not_user');
        $this->assertFalse($setted);

        $this->assertSame($this->session->get('user')['name'], $this->session->get('guest')['name']);
    }

    protected function assertSessionHasTheseKeys(array $array, array $keys)
    {
        // Checking all keys are the same
        // if all are the same return empty array[]
        $diff = array_diff($keys, array_keys($array));

        // if the same than true otherwise false
        $this->assertTrue(!$diff, 'The array does not contain the following keys: ' . implode(',', $keys));
    }
}
