<?php declare(strict_types = 1);

namespace App\Cache\Product;

use App\Cache\Cache;
use App\Cache\Storage\ICacheStorage;
use InvalidArgumentException;

final class ProductCache
{

	private const CACHE_NAMESPACE = 'product';

	private ICacheStorage $cacheStorage;

	public function __construct(ICacheStorage $cacheStorage)
	{
		$this->cacheStorage = $cacheStorage;
	}

	/**
	 * @return array<string, mixed>|null
	 */
	public function loadById(int $id): ?array
	{
		$cache = $this->getCache();
		$product = $cache->load((string) $id);
		if ($product !== null && !is_array($product)) {
			throw new InvalidArgumentException('Failed to retrieve cache data for product with ID "%d"');
		}

		return $product;
	}

	/**
	 * @param array<string, mixed> $product
	 */
	public function saveById(int $id, array $product): void
	{
		$cache = $this->getCache();

		$cache->save((string) $id, $product);
	}

	private function getCache(): Cache
	{
		return new Cache($this->cacheStorage, self::CACHE_NAMESPACE);
	}

}
