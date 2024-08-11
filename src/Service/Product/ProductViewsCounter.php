<?php declare(strict_types = 1);

namespace App\Service\Product;

use App\Utils\Strings;
use Exception;

final class ProductViewsCounter
{

	private const VALUE_SEPARATOR = ',';
	private const ROW_SEPARATOR = PHP_EOL;

	private const FILE_NAME = 'productViewCounts.txt';

	public function increaseViewCount(int $productId): void
	{
		$filePath = $this->getFilePath();
		$this->createFileIfNotExists($filePath);

		$file = fopen($filePath, 'r+w');
		if ($file === false) {
			throw new Exception(sprintf(
				'Failed to open file "%s"',
				$filePath,
			));
		}

		$flockOk = flock($file, LOCK_EX);
		if (!$flockOk) {
			throw new Exception(sprintf(
				'Failed to lock file "%s"',
				$filePath,
			));
		}

		$counts = $this->getAllCounts();
		if (array_key_exists($productId, $counts)) {
			$counts[$productId]++;
		} else {
			$counts[$productId] = 1;
		}

		foreach ($counts as $id => $count) {
			fwrite($file, sprintf(
				'%d%s%d%s',
				$id,
				self::VALUE_SEPARATOR,
				$count,
				self::ROW_SEPARATOR,
			));
		}

		flock($file, LOCK_UN);
		fclose($file);
	}

	/**
	 * @return array<int, int>
	 */
	public function getAllCounts(): array
	{
		$filePath = $this->getFilePath();

		$productCounts = [];
		if (file_exists($filePath)) {
			$data = file_get_contents($filePath);
			if ($data === false) {
				throw new Exception(sprintf(
					'Failed to open file "%s"',
					$filePath,
				));
			}

			if (!Strings::isEmpty($data)) {
				$rows = explode(self::ROW_SEPARATOR, $data);
				foreach ($rows as $row) {
					if (!Strings::isEmpty($row)) {
						$rowParsed = explode(self::VALUE_SEPARATOR, $row);
						$productCounts[(int) $rowParsed[0]] = (int) $rowParsed[1];
					}
				}
			}
		}

		return $productCounts;
	}

	private function getFilePath(): string
	{
		return sprintf(
			'%s/%s',
			VAR_DIR,
			self::FILE_NAME,
		);
	}

	private function createFileIfNotExists(string $filePath): void
	{
		if (!file_exists($filePath)) {
			file_put_contents($filePath, '');
		}
	}

}
