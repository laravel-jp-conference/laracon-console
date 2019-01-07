<?php
declare(strict_types=1);

namespace App\UseCases;

use App\Models\UserAccountCollection;
use SplFileObject;

/**
 * Class ImportTsvToUserAccounts
 * @package App\Usecases
 */
class ImportTsvToUserAccounts
{
    /**
     * @param string $fileName
     * @return UserAccountCollection
     * @throws \ErrorException
     */
    public function run(string $fileName): UserAccountCollection
    {
        $read_file_path = app_path($fileName);
        if (!file_exists($read_file_path)) {
            throw new \ErrorException("${fileName} is not exists");
        }
        $file = new SplFileObject($read_file_path, 'r');
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD); // 空行無視はSKIP_EMPTYとREAD_AHEADを共に設定する
        $file->setCsvControl("\t");

        foreach ($file as $row)
        {
            // FIXME
            dd($row);
        }
    }
}
