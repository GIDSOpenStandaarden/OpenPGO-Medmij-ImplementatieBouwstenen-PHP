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
