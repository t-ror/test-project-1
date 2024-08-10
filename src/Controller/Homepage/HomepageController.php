<?php declare(strict_types = 1);

namespace App\Controller\Homepage;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

final class HomepageController extends BaseController
{

	public function default(): Response
	{
		return $this->render('Homepage/templates/homepageDefault.html.twig');
	}

}
