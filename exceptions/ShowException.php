<?php
class ShowException extends Exception
{
    public function __construct(
        string $message = 'No se indicó el libro',
        string $responseMessage = 'No se indicó el libro',
        int $code = 400,
        Throwable $previous = NULL
    ) {
        parent::__construct($message, $code, $previous);
        header("HTTP/1.1 $code $responseMessage");
    }
}
