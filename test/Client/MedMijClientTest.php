<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\Client;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

abstract class MedMijClientTest extends TestCase
{
    /**
     * @test
     */
    abstract public function it_throws_when_content_type_is_not_xml();

    /**
     * @test
     */
    abstract protected function it_throws_when_xml_not_validated_against_xsd();

    /**
     * @param string $body
     *
     * @return Response
     */
    protected function createXmlResponseWithBody(string $body): Response
    {
        return new Response(200, ['Content-Type' => 'application/xml'], $body);
    }
}
