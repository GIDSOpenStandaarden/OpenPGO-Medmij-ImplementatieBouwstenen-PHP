<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\ZAL;

use JMS\Serializer\Annotation as JMS;

class TokenEndpoint
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("TokenEndpointuri")
     */
    private $tokenEndpointuri;

    /**
     * @param string $tokenEndpointuri
     */
    public function __construct(string $tokenEndpointuri)
    {
        $this->tokenEndpointuri = $tokenEndpointuri;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->tokenEndpointuri;
    }
}
