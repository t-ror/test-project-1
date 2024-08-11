<?php declare(strict_types = 1);

namespace App\ElasticSearch\Repository;

interface IRepository
{

	/**
	 * @return array<mixed>
	 */
	public function findById(int $id): array;

}
