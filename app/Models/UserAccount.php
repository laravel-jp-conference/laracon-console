<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class UserAccount
 * @package App\Models
 */
class UserAccount
{
    /** @var ?string */
    private $name;

    /** @var string */
    private $twitterAccount;

    /**
     * UserAccount constructor.
     * @param null|string $name
     * @param null|string $twitterAccount
     */
    public function __construct(?string $name, ?string $twitterAccount)
    {
        $this->name = $name;

        if (!is_null($twitterAccount)) {
            // 先頭・末尾のスペース削除
            $twitterAccount = rtrim(ltrim($twitterAccount));
            // アットマーク削除
            $twitterAccount = str_replace("@", "", $twitterAccount);
            $twitterAccount = str_replace("＠", "", $twitterAccount);
            $this->twitterAccount = $twitterAccount;
        }
    }

    /**
     * @return string
     */
    public function name(): string
    {
        if ($this->hasTwitter()) {
            return $this->twitterAccount;
        }
        return $this->name ?? "";
    }

    /**
     * @return bool
     */
    public function hasTwitter(): bool
    {
        return !is_null($this->twitterAccount);
    }

    /**
     * @return string
     */
    public function twitterUrl(): string
    {
        return "https://twitter.com/{$this->twitterAccount}";
    }
}
