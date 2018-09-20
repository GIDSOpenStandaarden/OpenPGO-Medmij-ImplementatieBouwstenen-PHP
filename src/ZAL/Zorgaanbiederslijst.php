<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\ZAL;

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("OAuthclientlist")
 * @JMS\XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @JMS\XmlNamespace(uri="xmlns://afsprakenstelsel.medmij.nl/zorgaanbiederslijst/release2/")
 */
class Zorgaanbiederslijst
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
     * @JMS\Type("array<MedMij\OpenPGO\ZAL\Zorgaanbieder>")
     * @JMS\XmlList(entry="Zorgaanbieder")
     * @JMS\SerializedName("Zorgaanbieders")
     */
    private $zorgaanbieders = [];
}
