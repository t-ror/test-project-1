<?php declare(strict_types = 1);

namespace App\ElasticSearch;

/**
 * Metodu findProduct() jsem dal pod IRepository jako findById()
 *
 * Kvůli jedonduchosti ponechávám custom connection (drive) do databáze jinak bych využil Doctrine.
 * Metoda jen pro ukázku aby bylo jasné k čemu interface slouží.
 */
interface IElasticSearchDrive
{

	/**
	 * @param array<int|string, mixed> $params
	 * @return array<mixed>
	 */
	public function executeQuery(string $query, array $params = []): array;

}
