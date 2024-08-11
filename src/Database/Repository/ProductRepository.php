<?php declare(strict_types = 1);

namespace App\Database\Repository;

use App\Database\IMySqlDrive;

final class ProductRepository implements IRepository
{

	private IMySqlDrive $mySqlDrive;

	public function __construct(IMySqlDrive $mySqlDrive)
	{
		$this->mySqlDrive = $mySqlDrive;
	}

	/**
	 * @return array<mixed>
	 */
	public function findById(int $id): array
	{
		return $this->mySqlDrive->executeQuery(
			'SELECT id, name FROM product WHERE product.id = :id',
			['id' => $id],
		);
	}

}
