<?php declare(strict_types = 1);

namespace App\Cache;

use App\Cache\Storage\ICacheStorage;

class Cache
{

	private ICacheStorage $cacheStorage;
	private ?string $namespace;

	public function __construct(ICacheStorage $cacheStorage, ?string $namespace = null)
	{
		$this->cacheStorage = $cacheStorage;
		$this->namespace = $namespace;
	}

	public function load(string $key): mixed
	{
		$keyHashed = $this->generateKeyHash($key);

		return $this->cacheStorage->read($keyHashed);
	}

	public function save(string $key, mixed $data): void
	{
		$keyHashed = $this->generateKeyHash($key);

		$this->cacheStorage->write($keyHashed, $data);
	}

	protected function generateKeyHash(string $key): string
	{
		return $this->namespace . md5($key);
	}

}
