<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\ZAL;

use JMS\Serializer\Annotation as JMS;

class AuthorizationEndpoint
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("AuthorizationEndpointuri")
     */
    private $authorizationEndpointuri;

    /**
     * @param string $authorizationEndpointuri
     */
    public function __construct(string $authorizationEndpointuri)
    {
        $this->authorizationEndpointuri = $authorizationEndpointuri;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->authorizationEndpointuri;
    }
}
