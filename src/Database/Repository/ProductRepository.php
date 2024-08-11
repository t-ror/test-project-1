<?php declare(strict_types = 1);

namespace App\Database\Repository;

use App\Database\IMySqlDriver;

final class ProductRepository implements IRepository
{

	private IMySqlDriver $mySqlDriver;

	public function __construct(IMySqlDriver $mySqlDriver)
	{
		$this->mySqlDriver = $mySqlDriver;
	}

	/**
	 * @return array<mixed>
	 */
	public function findById(int $id): array
	{
		return $this->mySqlDriver->executeQuery(
			'SELECT id, name FROM product WHERE product.id = :id',
			['id' => $id],
		);
	}

}
