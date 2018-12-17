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

class GegevensdienstnamenlijstService
{
    /**
     * @var GegevensdienstnamenlijstClient
     */
    private $client;

    /**
     * @param GegevensdienstnamenlijstClient $client
     */
    public function __construct(GegevensdienstnamenlijstClient $client)
    {
        $this->client = $client;
    }

    public function getGegevensdienstById(int $id): Gegevensdienst
    {
        /** @var Gegevensdienstnamenlijst $egevensdienstnamenlijst */
        $egevensdienstnamenlijst = $this->client->getGegevensdienstnamenlijst();
        foreach ($egevensdienstnamenlijst->getGegevensdiensten() as $egevensdienst) {
            if ($id === $egevensdienst->getGegevensdienstId()) {
                return $egevensdienst;
            }
        }

        throw GegevensdienstNotFoundException::withId($id);
    }
}
