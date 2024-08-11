<?php declare(strict_types = 1);

namespace App\Database\Repository;

interface IRepository
{

	/**
	 * @return array<mixed>
	 */
	public function findById(int $id): array;

}
