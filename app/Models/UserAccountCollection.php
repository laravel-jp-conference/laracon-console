<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class UserAccountCollection
 * @package App\Models
 */
class UserAccountCollection
{
    /** @var array  */
    private $accounts;

    /**
     * UserAccountCollection constructor.
     */
    public function __construct()
    {
        $this->accounts = new \ArrayIterator();
    }

    /**
     * @param UserAccount $account
     */
    public function add(UserAccount $account): void
    {
        array_push($this->accounts, $account);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        /** @var UserAccount $account */
        foreach ($this->accounts as $account) {
            if ($account->name() === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function remove(string $name): bool
    {
        if ($this->has($name)) {
            /**
             * @var int $key
             * @var UserAccount $account
             */
            foreach ($this->accounts as $key => $account) {
                if ($account->name() === $name) {
                    unset($this->accounts[$key]);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string $name
     * @return UserAccount|null
     */
    public function get(string $name): ?UserAccount
    {
        if ($this->has($name)) {
            /**
             * @var UserAccount $account
             */
            foreach ($this->accounts as $account) {
                if ($account->name() === $name) {
                    return $account;
                }
            }
        }
        return null;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->accounts);
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        return $this->accounts;
    }
}