<?php

require __dir__.'\\..\\vendor\\autoload.php';

use FForattini\Patterns\Singleton\Exceptions\InstanceAlreadyExistsException;
use FForattini\Patterns\Singleton\SingletonInterface;
use FForattini\Patterns\Singleton\Manager;

class Kernel extends Manager {}

class DatabaseManager implements SingletonInterface
{
    public $connections;

    public function __construct()
    {
        $this->connections = [];
    }

    public function addConnection($connection)
    {
        $this->connections[] = $connection;
    }
}

class SingletonTests extends PHPUnit_Framework_TestCase
{
    public function testIfItCanCreateAManager()
    {
        $manager = new Kernel();
        $this->assertEquals(is_null($manager), false);
        return $manager;
    }

    /**
     * @depends testIfItCanCreateAManager
     */
    public function testIfCanAddSingleton($manager)
    {
        $database = new DatabaseManager();
        $manager->add($database);
        $total = $manager->count();
        $this->assertEquals($total, 1);
        return $manager;
    }

    /**
     * @depends testIfCanAddSingleton
     * @expectedException FForattini\Patterns\Singleton\Exceptions\InstanceAlreadyExistsException
     */
    public function testeIfICanInsertTheSameClass($manager)
    {
        $database = new DatabaseManager();
        $manager->add($database);
    }
}
