<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\UserAccount;
use App\UseCases\ImportTsvToUserAccounts;
use App\UseCases\SaveTwitterImage;

/**
 * Class SaveAccountImageService
 * @package App\Services
 */
class SaveAccountImageService
{
    /** @var ImportTsvToUserAccounts */
    private $importTsv;

    /** @var SaveTwitterImage */
    private $saveImage;

    /**
     * SaveAccountImageService constructor.
     * @param ImportTsvToUserAccounts $importTsv
     * @param SaveTwitterImage $saveImage
     */
    public function __construct(
        ImportTsvToUserAccounts $importTsv,
        SaveTwitterImage $saveImage
    ) {
        $this->importTsv = $importTsv;
        $this->saveImage = $saveImage;
    }

    /**
     * @param string $fileName
     */
    public function execute(string $fileName)
    {
//        $this->importTsv->run($fileName);
//        $this->saveImage->run(new UserAccount("@laraveljpcon"));
    }
}
