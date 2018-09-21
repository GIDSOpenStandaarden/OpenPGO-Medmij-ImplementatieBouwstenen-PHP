<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\OCL;

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("OAuthclientlist")
 * @JMS\XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @JMS\XmlNamespace(uri="xmlns://afsprakenstelsel.medmij.nl/oauthclientlist/release2/")
 */
class OAuthClientList
{
    /**
     * @var \DateTimeImmutable
     * @JMS\Type("DateTimeImmutable")
     * @JMS\SerializedName("Tijdstempel")
     */
    private $tijdstempel;

    /**
     * @var int
     * @JMS\Type("int")
     * @JMS\SerializedName("Volgnummer")
     */
    private $volgnummer;

    /**
     * @var OAuthClient[]
     * @JMS\Type("array<MedMij\OpenPGO\OCL\OAuthClient>")
     * @JMS\XmlList(entry="OAuthclient")
     * @JMS\SerializedName("OAuthclients")
     */
    private $oAuthClients = [];
}
