<?php declare(strict_types = 1);

namespace App\Utils;

final class Strings
{

	public static function isEmpty(string $string): bool
	{
		return strlen($string) === 0;
	}

}
