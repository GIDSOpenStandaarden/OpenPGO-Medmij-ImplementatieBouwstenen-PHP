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

use MedMij\OpenPGO\Client\MedMijClient;

class WhitelistService
{
    /**
     * @var MedMijClient
     */
    private $client;

    /**
     * @param MedMijClient $client
     */
    public function __construct(MedMijClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $medMijNode
     *
     * @return bool
     */
    public function isMedMijNodeWhitelisted(string $medMijNode): bool
    {
        /** @var Whitelist $whitelist */
        $whitelist = $this->client->getWhitelist();

        return in_array($medMijNode, $whitelist->getMedMijNodes());
    }
}
