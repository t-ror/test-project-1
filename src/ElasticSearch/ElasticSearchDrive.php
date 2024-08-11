<?php declare(strict_types = 1);

namespace App\ElasticSearch;

final class ElasticSearchDrive implements IElasticSearchDrive
{

	/**
	 * @param array<int|string, mixed> $params
	 * @return array<mixed>
	 */
	public function executeQuery(string $query, array $params = []): array
	{
		// Fake logika jen pro ukázku, není napojení do databáze

		return [
			'id' => $params['id'],
			'name' => sprintf('Product %d', $params['id']),
		];
	}

}
