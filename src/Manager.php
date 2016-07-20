<?php
namespace FForattini\Patterns\Singleton;

use FForattini\Patterns\Singleton\Exceptions\InstanceAlreadyExistsException;

abstract class Manager
{
	/**
	 * Bi-dimensional array for instances repository.
	 * @var array
	 */
	protected $instances;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->instances = [];
	}

	/**
	 * Check if instance already exists for this class.
	 * @param  string $index It will be
	 * @return bool
	 */
	protected function exists($index)
	{
		return isset($this->instances[$index]);
	}

	/**
	 * Adds an instance into the instances repository.
	 * @param SingletonInterface $class
	 * @param string             $name (Optional) Custom key for the instance.
	 * @return Manager
	 */
	public function add(SingletonInterface $class, $name = null)
	{
		$index = (is_null($name)) ? get_class($name) : $name;
		$index = md5($index);

		if($this->exists($index)) {
			throw new InstanceAlreadyExistsException($class, $index);
		}

		$this->instances[$index] = $class;
		return $this;
	}

	/**
	 * Counts the amount of instances already added.
	 * @return integer
	 */
	public function count()
	{
		return count($this->instances);
	}

	/**
	 * Gets instance by the md5.
	 * @param  string $index [description]
	 * @return SingletonInterface
	 */
	protected function get($index)
	{
		return $this->instances[$index];
	}

	/**
	 * Gets instance by the name or class.
	 * @param  SingletonInterface|string $name_or_class
	 * @return SingletonInterface
	 */
	public function instance($name_or_class)
	{
		$index = (is_object($name_or_class)) ? get_class($name_or_class) : $name_or_class;
		$index = md5($index);
		return $this->get($index);
	}
}
