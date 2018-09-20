<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\Whitelist;

use JMS\Serializer\Annotation as JMS;
use Webmozart\Assert\Assert;

/**
 * @JMS\XmlRoot("Whitelist")
 * @JMS\XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @JMS\XmlNamespace(uri="xmlns://afsprakenstelsel.medmij.nl/whitelist/release2/")
 */
class Whitelist
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
     * @var string[]
     * @JMS\Type("array<string>")
     * @JMS\XmlList(entry="MedMijNode")
     * @JMS\SerializedName("MedMijNodes")
     */
    private $medMijNodes = [];

    /**
     * @param \DateTimeImmutable $tijdstempel
     * @param int                $volgnummer
     * @param string[]           $medMijNodes
     */
    public function __construct(\DateTimeImmutable $tijdstempel, int $volgnummer, array $medMijNodes)
    {
        Assert::allString($medMijNodes);

        $this->tijdstempel = $tijdstempel;
        $this->volgnummer = $volgnummer;
        $this->medMijNodes = $medMijNodes;
    }

    /**
     * @return string[]
     */
    public function getMedMijNodes(): array
    {
        return $this->medMijNodes;
    }
}
