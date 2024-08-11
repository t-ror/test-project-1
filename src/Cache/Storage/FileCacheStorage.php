<?php declare(strict_types = 1);

namespace App\Cache\Storage;

use Exception;

final class FileCacheStorage implements ICacheStorage
{

	public function read(string $key): mixed
	{
		$data = null;
		$filePath = $this->getFilePath($key);
		if (file_exists($filePath)) {
			$serializedData = file_get_contents($filePath);
			if ($serializedData === false) {
				throw new Exception(sprintf(
					'Failed to open cache file for key "%d"',
					$key,
				));
			}

			$data = unserialize($serializedData);
		}

		return $data;
	}

	public function write(string $key, mixed $data): void
	{
		$serializedData = serialize($data);
		$cacheDirectory = $this->getCacheDirectory();
		if (!is_dir($cacheDirectory)) {
			mkdir($cacheDirectory);
		}

		file_put_contents($this->getFilePath($key), $serializedData);
	}

	private function getCacheDirectory(): string
	{
		return sprintf(
			'%s/file',
			CACHE_DIR,
		);
	}

	private function getFilePath(string $key): string
	{
		return sprintf(
			'%s/%s.txt',
			$this->getCacheDirectory(),
			$key,
		);
	}

}
