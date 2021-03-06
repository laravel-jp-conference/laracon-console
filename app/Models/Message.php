<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class Message
 * @package App\Models
 */
class Message
{
    /** @var string  */
    private $type;

    /** @var string  */
    private $message;

    /**
     * Message constructor.
     * @param string $type
     * @param string $message
     */
    public function __construct(string $type, string $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
