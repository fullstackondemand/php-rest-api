<?php
declare(strict_types=1);
namespace RestJS\Class;

/** Create Response Object */
class Response {
    public function __construct(
        public int $statusCode = 200,
        public string $message = '',
        public mixed $data = [],
        public bool $status = true
    ) {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
    }
}