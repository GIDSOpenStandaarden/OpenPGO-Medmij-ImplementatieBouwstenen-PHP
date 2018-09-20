<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\Client;

class InvalidContentTypeException extends \RuntimeException
{
    public static function withContentType(string $contentType)
    {
        return new InvalidContentTypeException('invalid content type: '.$contentType);
    }
}
