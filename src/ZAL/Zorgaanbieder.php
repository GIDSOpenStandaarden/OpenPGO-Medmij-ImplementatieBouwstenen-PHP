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
use Webmozart\Assert\Assert;

class Zorgaanbieder
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("Zorgaanbiedernaam")
     */
    private $zorgaanbiedernaam;

    /**
     * @var Gegevensdienst[]
     * @JMS\Type("array<MedMij\OpenPGO\ZAL\Gegevensdienst>")
     * @JMS\XmlList(entry="Gegevensdienst")
     * @JMS\SerializedName("Gegevensdiensten")
     */
    private $gegevensdiensten = [];

    /**
     * @param string $zorgaanbiedernaam
     * @param array  $gegevensdiensten
     */
    public function __construct(string $zorgaanbiedernaam, array $gegevensdiensten)
    {
        Assert::allIsInstanceOf($gegevensdiensten, Gegevensdienst::class);

        $this->zorgaanbiedernaam = $zorgaanbiedernaam;
        $this->gegevensdiensten = $gegevensdiensten;
    }

    /**
     * @return string
     */
    public function getZorgaanbiedernaam(): string
    {
        return $this->zorgaanbiedernaam;
    }

    /**
     * @param string $gegevensdienstId
     *
     * @return Gegevensdienst
     */
    public function getGegevensdienst(string $gegevensdienstId): Gegevensdienst
    {
        foreach ($this->gegevensdiensten as $gegevensdienst) {
            if ($gegevensdienstId === $gegevensdienst->getGegevensdienstId()) {
                return $gegevensdienst;
            }
        }

        throw GegevensdienstNotFoundException::withId($gegevensdienstId);
    }
}
