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

namespace MedMij\OpenPGO\OCL;

use JMS\Serializer\Annotation as JMS;
use Webmozart\Assert\Assert;

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

    /**
     * @param \DateTimeImmutable $tijdstempel
     * @param int                $volgnummer
     * @param OAuthClient[]      $oAuthClients
     */
    public function __construct(\DateTimeImmutable $tijdstempel, int $volgnummer, array $oAuthClients)
    {
        Assert::allIsInstanceOf($oAuthClients, OAuthClient::class);

        $this->tijdstempel = $tijdstempel;
        $this->volgnummer = $volgnummer;
        $this->oAuthClients = $oAuthClients;
    }

    /**
     * @return OAuthClient[]
     */
    public function getOAuthClients(): array
    {
        return $this->oAuthClients;
    }
}
