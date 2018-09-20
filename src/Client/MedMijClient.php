<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

class MedMijClient
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    private $schema;

    /**
     * @param HttpClient $httpClient
     * @param string     $endpoint
     * @param string     $schema
     */
    public function __construct(HttpClient $httpClient, string $endpoint, string $schema)
    {
        $this->httpClient = $httpClient;
        $this->endpoint = $endpoint;
        $this->schema = $schema;
    }

    /**
     * @param Response $response
     */
    protected function assertXmlContentType(Response $response)
    {
        if (!$response->hasHeader('Content-Type') || empty(array_intersect($response->getHeader('Content-Type'), ['text/xml', 'application/xml']))) {
            throw InvalidContentTypeException::withContentType($response->getHeaderLine('Content-Type'));
        }
    }

    /**
     * @param \DOMDocument $document
     */
    protected function assertValidSchema(\DOMDocument $document)
    {
        if (!@$document->schemaValidateSource($this->schema)) {
            throw new InvalidXmlException();
        }
    }
}
