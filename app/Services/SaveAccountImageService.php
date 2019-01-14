<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\UserAccount;
use App\UseCases\ExportUserAccountToCsv;
use App\UseCases\ImportUserAccountsToTsv;
use App\UseCases\SaveDefaultImage;
use App\UseCases\SaveTwitterImage;

/**
 * Class SaveAccountImageService
 * @package App\Services
 */
class SaveAccountImageService
{
    /** @var ImportUserAccountsToTsv */
    private $importTsv;

    /** @var SaveTwitterImage */
    private $saveImage;

    /** @var SaveDefaultImage  */
    private $saveDefaultImage;

    /** @var ExportUserAccountToCsv  */
    private $exportCsv;

    /**
     * SaveAccountImageService constructor.
     * @param ImportUserAccountsToTsv $importTsv
     * @param SaveTwitterImage $saveImage
     * @param SaveDefaultImage $defaultImage
     * @param ExportUserAccountToCsv $exportCsv
     */
    public function __construct(
        ImportUserAccountsToTsv $importTsv,
        SaveTwitterImage $saveImage,
        SaveDefaultImage $defaultImage,
        ExportUserAccountToCsv $exportCsv
    ) {
        $this->importTsv = $importTsv;
        $this->saveImage = $saveImage;
        $this->saveDefaultImage = $defaultImage;
        $this->exportCsv = $exportCsv;
    }

    /**
     * @param string $fileName
     * @throws \ErrorException
     */
    public function execute(string $fileName)
    {
        $collection = $this->importTsv->run($fileName);

        $i = 0;
        $progressBar = new \ProgressBar\Manager(0, $collection->count());

        /** @var UserAccount $account */
        foreach ($collection->generator() as $account) {
            try {
                if ($account->hasTwitter()) {
                    $this->saveImage->run($account);
                } else {
                    $this->saveDefaultImage->run($account);
                }
                $this->exportCsv->run($account);
            } catch (\ErrorException $e) {
                dd($e);
            }
            $progressBar->update(++$i);
            // 1sec interval
            sleep(1);
        }
    }
}
