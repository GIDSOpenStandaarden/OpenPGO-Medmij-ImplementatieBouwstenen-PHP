<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\OCL;

use JMS\Serializer\Annotation as JMS;

class OAuthClient
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("Hostname")
     */
    private $hostname;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("OAuthclientOrganisatienaam")
     */
    private $organisatieNaam;

    /**
     * @param string $hostname
     * @param string $organisatieNaam
     */
    public function __construct(string $hostname, string $organisatieNaam)
    {
        $this->hostname = $hostname;
        $this->organisatieNaam = $organisatieNaam;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }
}
