<?php

/**
 * Copyright (C) 2018 Mainly Code
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>
 */

declare(strict_types=1);

namespace MedMij\OpenPGO\GNL;

use JMS\Serializer\Annotation as JMS;
use Webmozart\Assert\Assert;

/**
 * @JMS\XmlRoot("Gegevensdienstnamenlijst")
 * @JMS\XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @JMS\XmlNamespace(uri="xmlns://afsprakenstelsel.medmij.nl/gegevensdienstnamenlijst/release1/")
 */
class Gegevensdienstnamenlijst
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
     * @var Gegevensdienst[]
     * @JMS\Type("array<MedMij\OpenPGO\GNL\Gegevensdienst>")
     * @JMS\XmlList(entry="Gegevensdienst")
     * @JMS\SerializedName("Gegevensdienst")
     */
    private $gegevensdiensten = [];

    /**
     * @param \DateTimeImmutable $tijdstempel
     * @param int                $volgnummer
     * @param Gegevensdienst[]   $gegevensdiensten
     */
    public function __construct(\DateTimeImmutable $tijdstempel, int $volgnummer, array $gegevensdiensten)
    {
        Assert::allIsInstanceOf($gegevensdiensten, Gegevensdienst::class);

        $this->tijdstempel = $tijdstempel;
        $this->volgnummer = $volgnummer;
        $this->gegevensdiensten = $gegevensdiensten;
    }

    /**
     * @return Gegevensdienst[]
     */
    public function getGegevensdiensten(): array
    {
        return $this->gegevensdiensten;
    }
}
