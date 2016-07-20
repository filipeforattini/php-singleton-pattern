<?php
namespace FForattini\Patterns\Singleton\Exceptions;

use FForattini\Patterns\Singleton\SingletonInterface;
use Exception;

class InstanceAlreadyExistsException extends Exception
{
	protected $singleton;
	protected $index;

	/**
	 * Constructor.
	 * @param SingletonInterface $class
	 * @param string             $index
	 */
	public function __construct(SingletonInterface $class, $index)
	{
		$this->singleton = $class;
		$this->index = $index;
	}

	/**
	 * Returns duplicated instance.
	 * @return SingletonInterface
	 */
	public function getSingleton()
	{
		return $this->singleton;
	}

	/**
	 * Returns duplicated md5.
	 * @return string
	 */
	public function getIndex()
	{
		return $this->index;
	}
}