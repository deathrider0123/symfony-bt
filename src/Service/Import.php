<?php
namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Filesystem\Filesystem;

class Import
{
    private $importDirectory;
    private $archiveDirectory;
    private $em;
    private const FILENAME = 'data.xls';

    public function __construct($importDirectory, $archiveDirectory, EntityManager $userManager)
    {
        $this->importDirectory = $importDirectory;
        $this->archiveDirectory = $archiveDirectory;
        $this->em = $userManager;
    }

    public function import()
    {

        $importFileName = $this->importDirectory . DIRECTORY_SEPARATOR . self::FILENAME;
        $spreadsheet = IOFactory::load($importFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $inserted_lines = 0;

        foreach ($sheetData as $i => $row) {
            if ($i > 1) { //start from the second row
                $this->processRow($row);
                $inserted_lines++;
            }
        }
        $this->em->flush();

        //move file to archive directory
        $filesystem = new Filesystem();
        $datetime = new \DateTime();
        $fileName = $datetime->format('Y_m_d_h_i_s') . '_data_archived.xls';
        $filesystem->copy($importFileName, $this->archiveDirectory . DIRECTORY_SEPARATOR . $fileName);
        //delete original file from import directory
        $filesystem->remove($importFileName);

        return $inserted_lines;
    }

    public function processRow($row)
    {
        $product = new Product();
        $product
            ->setModel($row['A'])
            ->setQuantity($row['B'])
            ->setPrice($row['C'])
            ->setDescription($row['D'])
            ->setCreatedAt(new \DateTime());
        $this->em->persist($product);
    }
}