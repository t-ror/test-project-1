<?php declare(strict_types = 1);

namespace App\ElasticSearch\Repository;

use App\ElasticSearch\IElasticSearchDriver;

final class ProductRepository implements IRepository
{

	private IElasticSearchDriver $elasticSearchDriver;

	public function __construct(IElasticSearchDriver $elasticSearchDriver)
	{
		$this->elasticSearchDriver = $elasticSearchDriver;
	}

	/**
	 * @return array<mixed>
	 */
	public function findById(int $id): array
	{
		return $this->elasticSearchDriver->executeQuery(
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
