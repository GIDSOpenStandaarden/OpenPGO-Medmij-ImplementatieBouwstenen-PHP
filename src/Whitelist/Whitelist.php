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
     * @var MedMijNode[]
     * @JMS\Type("array<MedMij\OpenPGO\Whitelist\MedMijNode>")
     * @JMS\XmlList(entry="MedMijNode")
     * @JMS\SerializedName("MedMijNodes")
     */
    private $medMijNodes = [];

    /**
     * @param \DateTimeImmutable $tijdstempel
     * @param int                $volgnummer
     * @param MedMijNode[]       $medMijNodes
     */
    public function __construct(\DateTimeImmutable $tijdstempel, int $volgnummer, array $medMijNodes)
    {
        Assert::allIsInstanceOf($medMijNodes, MedMijNode::class);

        $this->tijdstempel = $tijdstempel;
        $this->volgnummer = $volgnummer;
        $this->medMijNodes = $medMijNodes;
    }

    /**
     * @return MedMijNode[]
     */
    public function getMedMijNodes(): array
    {
        return $this->medMijNodes;
    }
}
