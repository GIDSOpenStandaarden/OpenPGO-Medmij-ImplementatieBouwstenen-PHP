<?php

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
