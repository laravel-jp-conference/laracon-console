<?php
declare(strict_types=1);

namespace App\UseCases;

use App\Models\UserAccount;

/**
 * Class ExportUserAccountToCsv
 * @package App\UseCases
 */
class ExportUserAccountToCsv
{
    /** @var bool|resource  */
    private $file;

    /**
     * ExportUserAccountToCsv constructor.
     */
    public function __construct()
    {
        $fileName = base_path("storage/name.csv");
        if (file_exists($fileName)) {
            unlink($fileName);
        }
        touch($fileName);
        $this->file = fopen($fileName, "w");
        fputcsv($this->file, ["order_id", "name"]);
    }

    /**
     * @param UserAccount $account
     */
    public function run(UserAccount $account): void
    {
        if ($this->file) {
            fputcsv($this->file, [$account->order(), $account->name()]);
        }
    }
}
