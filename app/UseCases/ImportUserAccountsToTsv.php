<?php
declare(strict_types=1);

namespace App\UseCases;

use App\Models\UserAccount;
use App\Models\UserAccountCollection;
use SplFileObject;

/**
 * Class ImportUserAccountsToTsv
 * @package App\Usecases
 */
class ImportUserAccountsToTsv
{
    /**
     * @param string $fileName
     * @return UserAccountCollection
     * @throws \ErrorException
     */
    public function run(string $fileName): UserAccountCollection
    {
        setlocale(LC_ALL,'ja_JP.UTF-8');
        $read_file_path = base_path($fileName);
        if (!file_exists($read_file_path)) {
            throw new \ErrorException("${$read_file_path} is not exists");
        }
        $file = new SplFileObject($read_file_path, 'r');
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD); // 空行無視はSKIP_EMPTYとREAD_AHEADを共に設定する
        $file->setCsvControl("\t");

        $collection = new UserAccountCollection();
        foreach ($file as $key => $row)
        {
            if ($key === 0) continue;
            $order = (int) $row[0];
            $name = $row[11] ?? null;
            $twitter = $row[10] ?? null;
            $collection->add(new UserAccount($order, $name, $twitter));
        }
        return $collection;
    }
}
