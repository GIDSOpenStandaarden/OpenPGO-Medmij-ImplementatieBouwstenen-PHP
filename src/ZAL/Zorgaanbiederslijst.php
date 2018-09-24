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
