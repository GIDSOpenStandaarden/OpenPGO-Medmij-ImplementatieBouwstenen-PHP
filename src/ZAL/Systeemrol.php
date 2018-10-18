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

class Systeemrol
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("Systeemrolcode")
     */
    private $systeemrolcode;

    /**
     * @var ResourceEndpoint
     * @JMS\Type("MedMij\OpenPGO\ZAL\ResourceEndpoint")
     * @JMS\SerializedName("ResourceEndpoint")
     */
    private $resourceEndpoint;

    /**
     * @param string           $systeemrolcode
     * @param ResourceEndpoint $resourceEndpoint
     */
    public function __construct(string $systeemrolcode, ResourceEndpoint $resourceEndpoint)
    {
        $this->systeemrolcode = $systeemrolcode;
        $this->resourceEndpoint = $resourceEndpoint;
    }

    /**
     * @return string
     */
    public function getSysteemrolcode(): string
    {
        return $this->systeemrolcode;
    }

    /**
     * @return ResourceEndpoint
     */
    public function getResourceEndpoint(): ResourceEndpoint
    {
        return $this->resourceEndpoint;
    }
}
