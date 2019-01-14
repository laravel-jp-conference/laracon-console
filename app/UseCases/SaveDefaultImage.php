<?php
declare(strict_types=1);

namespace App\UseCases;

use App\Models\UserAccount;
use Illuminate\Filesystem\FilesystemManager;
use Intervention\Image\ImageManager;

/**
 * Class SaveDefaultImage
 * @package App\UseCases
 */
class SaveDefaultImage
{
    /**
     * @var FilesystemManager
     */
    private $filesystemManager;

    /**
     * SaveDefaultImage constructor.
     * @param FilesystemManager $filesystemManager
     */
    public function __construct(FilesystemManager $filesystemManager)
    {
        $this->filesystemManager = $filesystemManager;
    }

    /**
     * @param UserAccount $account
     * @return bool
     * @throws \ErrorException
     */
    public function run(UserAccount $account): bool
    {
        if (!$this->filesystemManager->exists("/storage/default.jpg")) {
            throw new \ErrorException("Not found default.jpg");
        }
        return $this->filesystemManager->copy(
            "/storage/default.jpg",
            "/storage/images/{$account->name()}.jpg"
        );
    }
}
