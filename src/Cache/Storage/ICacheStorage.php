<?php declare(strict_types = 1);

namespace App\Cache\Storage;

interface ICacheStorage
{

	public function read(string $key): mixed;

	public function write(string $key, mixed $data): void;

}
