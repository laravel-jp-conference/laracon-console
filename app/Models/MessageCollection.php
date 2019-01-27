<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class MessageCollection
 * @package App\Models
 */
class MessageCollection
{
    /** @var array  */
    private $messages;

    /**
     * MessageCollection constructor.
     */
    public function __construct()
    {
        $this->messages = [];
    }

    /**
     * @param Message $message
     */
    public function add(Message $message): void
    {
        array_push($this->messages, $message);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->messages);
    }

    /**
     * @return \Generator
     */
    public function generator(): \Generator
    {
        foreach ($this->messages as $message) {
            yield $message;
        }
    }
}
