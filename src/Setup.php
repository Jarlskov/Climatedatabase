<?php

declare(strict_types=1);

namespace Jarlskov\Climatedatabase;

use Jarlskov\Climatedatabase\Models\Category;
use Jarlskov\Climatedatabase\Models\Item;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Setup
{
    const DOWNLOAD_URL =
        'https://denstoreklimadatabase.dk/sites/klimadatabasen.dk/files/media/document/Results_FINAL_20210201v4.xlsx';
    const WORKSHEET_NAME = 'Ra_500food';

    /**
     * Get the full content of the climate database.
     *
     * @param string $filePath
     *          Optional file path.
     *          If the database doesn't exist in the provided path it will be downloaded and stored in the path.
     *          If no path is provided a temp file will be created.
     *
     * @return array<Item>
     */
    public function getDatabase(string $filePath = null): array
    {
        $worksheet = $this->getWorksheet($filePath);

        return $this->createItemsFromWorksheet($worksheet);
    }

    /**
     * Download the database excel file.
     *
     * @return string
     *      Optional download path, if path isn't provided a temp file will be created.
     */
    public function downloadDatabase(string $downloadPath = null): string
    {
        $downloadPath = $downloadPath ?: tempnam(sys_get_temp_dir(), '');

        if (!$downloadPath) {
            throw new \RuntimeException("Temp file couldn't be created");
        }

        if (file_put_contents($downloadPath, file_get_contents(self::DOWNLOAD_URL))) {
            return $downloadPath;
        } else {
            throw new \RuntimeException('Download failed');
        }
    }

    /**
     * @return array<Item>
     */
    private function createItemsFromWorksheet(Worksheet $worksheet): array
    {
        $categories = [];
        $items = [];

        foreach ($worksheet->getRowIterator(2) as $row) {
            $csvArray = [];

            foreach ($row->getCellIterator() as $cell) {
                $csvArray[$cell->getColumn()] = $cell->getValue();
            }

            $categoryId = $this->getCategoryId($csvArray);
            if (is_null($categoryId)) {
                break;
            }

            if (!array_key_exists($categoryId, $categories)) {
                $categories[$categoryId] = $this->arrayToCategory($csvArray);
            }
            $category = $categories[$categoryId];

            $items[] = $this->arrayToItem($csvArray, $category);
        }

        return $items;
    }

    /**
     * @param array<string, mixed> $csvArray
     */
    private function arrayToCategory(array $csvArray): Category
    {
        return new Category(
            strval($csvArray['E']), // name
            strval($csvArray['C']), // danishName
            strval($csvArray['X']), // gpcCategory
            strval($csvArray['Y']), // danishGpcCategory
            is_int($csvArray['AB']) ? $csvArray['AB'] : 0, // gpcBrickLevel1
            strval($csvArray['AC']), // gpcBrickLevel1Name
            is_int($csvArray['AD']) ? $csvArray['AD'] : 0, // gpcBrickLevel2
            strval($csvArray['AE']), // gpcBrickLevel2Name
            is_int($csvArray['AF']) ? $csvArray['AF'] : 0, // gpcBrickLevel3
            strval($csvArray['AG']) // gpcBrickLevel4
        );
    }

    /**
     * @param array<string, mixed> $csvArray
     * @param Category $category
     */
    private function arrayToItem(array $csvArray, Category $category): Item
    {
        return new Item(
            $category,
            strval($csvArray['D']), // name
            strval($csvArray['B']), // danishName
            strval($csvArray['F']), // unit
            floatval($csvArray['M']), // co2e
            floatval($csvArray['G']), // agriculture
            floatval($csvArray['H']), // iluc
            floatval($csvArray['I']), // processing
            floatval($csvArray['J']), // packaging
            floatval($csvArray['K']), // transport
            floatval($csvArray['L']), // retail
            floatval($csvArray['N']), // energy
            floatval($csvArray['O']), // fat
            is_float($csvArray['P']) ? $csvArray['P'] : 0.0, // carbohydrate
            is_float($csvArray['Q']) ? $csvArray['Q'] : 0.0 // protein
        );
    }

    /**
     * @param array<string, mixed> $csvArray
     */
    private function getCategoryId(array $csvArray): ?int
    {
        return is_null($csvArray['AF']) ? null : intval($csvArray['AF']);
    }

    private function getFile(string $filePath = null): string
    {
        if ($filePath && file_exists($filePath)) {
            return $filePath;
        }

        return $this->downloadDatabase($filePath);
    }

    private function getWorksheet(string $filePath = null): Worksheet
    {
        $spreadsheet = IOFactory::load($this->getFile($filePath));
        $worksheet = $spreadsheet->getSheetByName(self::WORKSHEET_NAME);

        if (!$worksheet) {
            throw new \Exception('Worksheet not found. Data unavailable');
        }

        return $worksheet;
    }
}
