<?php declare(strict_types = 1);

namespace App\Service\Product;

use App\Cache\Product\ProductCache;
use App\Database\Repository\ProductRepository as MySqlProductRepository;
use App\ElasticSearch\Repository\ProductRepository as ElasticProductRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class ProductProvider
{

	private ParameterBagInterface $appConfigParameters;
	private ProductCache $productCache;
	private MySqlProductRepository $mysqlProductRepository;
	private ElasticProductRepository $elasticProductRepository;

	public function __construct(
		ParameterBagInterface $appConfigParameters,
		ProductCache $productCache,
		MySqlProductRepository $mysqlProductRepository,
		ElasticProductRepository $elasticProductRepository,
	)
	{
		$this->appConfigParameters = $appConfigParameters;
		$this->productCache = $productCache;
		$this->mysqlProductRepository = $mysqlProductRepository;
		$this->elasticProductRepository = $elasticProductRepository;
	}

	/**
	 * Vracel bych value object krom pole, ale kvůli zachování jednoduchoti nechám pole
	 *
	 * @return array<string, mixed>
	 */
	public function getProduct(int $id): array
	{
		$productCached = $this->productCache->loadById($id);

		if ($productCached !== null) {
			$product = $productCached;
		} elseif ($this->appConfigParameters->get('app.elasticSearchActive') === true) {
			$product = $this->elasticProductRepository->findById($id);
		} else {
			$product = $this->mysqlProductRepository->findById($id);
		}

		if ($productCached === null) {
			$this->productCache->saveById($id, $product);
		}

		return $product;
	}

}
