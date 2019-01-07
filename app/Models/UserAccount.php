<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class UserAccount
 * @package App\Models
 */
class UserAccount
{
    /** @var string */
    private $name;

    /**
     * UserAccount constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        // 先頭・末尾のスペース削除
        $name = rtrim(ltrim($name));
        // アットマーク削除
        $name = str_replace("@", "", $name);
        $name = str_replace("＠", "", $name);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function twitterUrl(): string
    {
        return "https://twitter.com/{$this->name}";
    }
}
