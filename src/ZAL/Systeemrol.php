<?php

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
}
