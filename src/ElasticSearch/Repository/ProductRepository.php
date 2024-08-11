<?php declare(strict_types = 1);

namespace App\ElasticSearch\Repository;

use App\ElasticSearch\IElasticSearchDrive;

final class ProductRepository implements IRepository
{

	private IElasticSearchDrive $elasticSearchDrive;

	public function __construct(IElasticSearchDrive $elasticSearchDrive)
	{
		$this->elasticSearchDrive = $elasticSearchDrive;
	}

	/**
	 * @return array<mixed>
	 */
	public function findById(int $id): array
	{
		return $this->elasticSearchDrive->executeQuery(
			'
			GET product/_search
			"match": {
				"id": {
					"query": ":id"
				}
			}
			',
			['id' => $id],
		);
	}

}
