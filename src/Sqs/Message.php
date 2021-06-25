<?php

namespace Sonergia\Aws\Sqs;

class Message
{
    private $id;
    private $handle;
    private $body;
    private $attributes;
   

    public function __construct(string $body, array $attributes = [], ?string $id = null, ?string $handle = null)
    {
        $this->body = $body;
        $this->attributes = $attributes;
        $this->id = $id;
        $this->handle = $handle;
    }

    public function __toString()
    {
        return $this->body;
    }

    /**
     * message Handle
     *
     * @return string
     */
    public function handle(): string
    {
        return $this->handle;
    }

    /**
     * message attributes
     *
     * @return array
     */
    public function attributes(): array
    {
        return $this->attributes;
    }
}
