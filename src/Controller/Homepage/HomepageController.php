<?php declare(strict_types = 1);

namespace App\Controller\Homepage;

use App\Controller\BaseController;
use App\Service\Product\ProductViewsCounter;
use Symfony\Component\HttpFoundation\Response;

final class HomepageController extends BaseController
{

	private ProductViewsCounter $productViewsCounter;

	public function __construct(ProductViewsCounter $productViewsCounter)
	{
		$this->productViewsCounter = $productViewsCounter;
	}

	public function default(): Response
	{
		return $this->render(
			'Homepage/templates/homepageDefault.html.twig',
			[
				'products' => $this->getTestProductData(),
				'productViewCounts' => $this->productViewsCounter->getAllCounts(),
			],
		);
	}

	/**
	 * Test data
	 *
	 * @return array<int, array<string, mixed>>
	 */
	private function getTestProductData(): array
	{
		$products = [];
		for ($i = 1; $i <= 10; $i++) {
			$products[] = [
				'id' => $i,
				'name' => sprintf('Product %d', $i),
			];
		}

		return $products;
	}

}
