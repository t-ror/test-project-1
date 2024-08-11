<?php declare(strict_types = 1);

namespace App\ElasticSearch;

/**
 * Metodu findById() jsem dal pod IRepository

 * Metoda jen pro ukázku aby bylo jasné k čemu interface slouží.
 */
interface IElasticSearchDriver
{

	/**
	 * @param array<int|string, mixed> $params
	 * @return array<mixed>
	 */
	public function executeQuery(string $query, array $params = []): array;

}
