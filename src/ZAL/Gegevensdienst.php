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

class Gegevensdienst
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("GegevensdienstId")
     */
    private $gegevensdienstId;

    /**
     * @var AuthorizationEndpoint
     * @JMS\Type("MedMij\OpenPGO\ZAL\AuthorizationEndpoint")
     * @JMS\SerializedName("AuthorizationEndpoint")
     */
    private $authorizationEndpoint;

    /**
     * @var TokenEndpoint
     * @JMS\Type("MedMij\OpenPGO\ZAL\TokenEndpoint")
     * @JMS\SerializedName("TokenEndpoint")
     */
    private $tokenEndpoint;

    /**
     * @var Systeemrol[]
     * @JMS\Type("array<MedMij\OpenPGO\ZAL\Systeemrol>")
     * @JMS\XmlList(entry="Systeemrol")
     * @JMS\SerializedName("Systeemrollen")
     */
    private $systeemrollen = [];

    /**
     * @param string                $gegevensdienstId
     * @param AuthorizationEndpoint $authorizationEndpoint
     * @param TokenEndpoint         $tokenEndpoint
     * @param Systeemrol[]          $systeemrollen
     */
    public function __construct(string $gegevensdienstId, AuthorizationEndpoint $authorizationEndpoint, TokenEndpoint $tokenEndpoint, array $systeemrollen)
    {
        Assert::allIsInstanceOf($systeemrollen, Systeemrol::class);

        $this->gegevensdienstId = $gegevensdienstId;
        $this->authorizationEndpoint = $authorizationEndpoint;
        $this->tokenEndpoint = $tokenEndpoint;
        $this->systeemrollen = $systeemrollen;
    }

    /**
     * @return AuthorizationEndpoint
     */
    public function getAuthorizationEndpoint(): AuthorizationEndpoint
    {
        return $this->authorizationEndpoint;
    }

    /**
     * @return TokenEndpoint
     */
    public function getTokenEndpoint(): TokenEndpoint
    {
        return $this->tokenEndpoint;
    }
}
