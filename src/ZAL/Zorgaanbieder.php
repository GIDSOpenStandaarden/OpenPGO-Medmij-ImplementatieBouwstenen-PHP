<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\ZAL;

use JMS\Serializer\Annotation as JMS;

class Zorgaanbieder
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("Zorgaanbiedernaam")
     */
    private $zorgaanbiedernaam;

    /**
     * @property Gegevensdienst[] $gegevensdiensten
     * @JMS\Type("array<MedMij\OpenPGO\ZAL\Gegevensdienst>")
     * @JMS\XmlList(entry="Gegevensdienst")
     * @JMS\SerializedName("Gegevensdiensten")
     */
    private $gegevensdiensten = [];
}
