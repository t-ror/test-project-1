<?php declare(strict_types = 1);

namespace App\Controller\Product;

use App\Controller\BaseController;
use App\Service\Product\ProductProvider;
use App\Service\Product\ProductViewsCounter;
use App\Utils\Strings;
use Symfony\Component\HttpFoundation\Response;

final class ProductController extends BaseController
{

	private ProductProvider $productProvider;
	private ProductViewsCounter $productViewsCounter;

	public function __construct(ProductProvider $productProvider, ProductViewsCounter $productViewsCounter)
	{
		$this->productProvider = $productProvider;
		$this->productViewsCounter = $productViewsCounter;
	}

	public function detail(string $id): Response
	{
		if (Strings::isEmpty($id) || !ctype_digit($id)) {
			return $this->redirectToRoute('Homepage');
		}

		$product = $this->productProvider->getProduct((int) $id);

		$this->productViewsCounter->increaseViewCount((int) $id);

		return $this->json($product);
	}

}
