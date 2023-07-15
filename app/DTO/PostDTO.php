<?php

namespace App\DTO;

class PostDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $title,
        public readonly string $body,
        public string $authorName
    ){}

    public function toArray(): array
    {
        return (array) $this;
    }

    public function toApiArray(): array
    {
        return [
            'title' => $this->title,
            'body'  => $this->body
        ];
    }
}
