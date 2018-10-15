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

class ZorgaanbiederService
{
    /**
     * @var ZALClient
     */
    private $client;

    /**
     * @param ZALClient $client
     */
    public function __construct(ZALClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $name
     *
     * @throws ZorgaanbiederNotFoundException
     *
     * @return Zorgaanbieder
     */
    public function getZorgaanbiederByName(string $name): Zorgaanbieder
    {
        /** @var Zorgaanbiederslijst $zorgaanbiederslijst */
        $zorgaanbiederslijst = $this->client->getZAL();
        foreach ($zorgaanbiederslijst->getZorgaanbieders() as $zorgaanbieder) {
            if ($name === $zorgaanbieder->getZorgaanbiedernaam()) {
                return $zorgaanbieder;
            }
        }

        throw ZorgaanbiederNotFoundException::withName($name);
    }
}
