<?php
declare(strict_types=1);

namespace App\UseCases;

use phpQuery;
use App\Models\UserAccount;
use Intervention\Image\ImageManager;

/**
 * Class SaveTwitterImage
 * @package App\Usecases
 */
class SaveTwitterImage
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * SaveTwitterImage constructor.
     * @param ImageManager $imageManager
     */
    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * @param UserAccount $account
     * @return bool
     * @throws \ErrorException
     */
    public function run(UserAccount $account): bool
    {
        try {
            $html = file_get_contents($account->twitterUrl());
            $src = phpQuery::newDocument($html)->find(".ProfileAvatar-image")->attr("src");
            if ($src !== "") {
                // remove _400x400
                $src = str_replace("_400x400", "", $src);
                $this->imageManager->make($src)->fit(500, 500,
                    function (\Intervention\Image\Constraint $constraint) {
                        $constraint->aspectRatio();
                    })->save(base_path("/storage/images/{$account->name()}.jpg"), 90);

                return true;
            }

            return false;
        } catch (\Throwable $e) {
            throw new \ErrorException($e->getMessage());
        }
    }
}
