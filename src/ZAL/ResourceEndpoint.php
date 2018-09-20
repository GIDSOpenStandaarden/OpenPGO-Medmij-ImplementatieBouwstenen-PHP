<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\ZAL;

use JMS\Serializer\Annotation as JMS;

class ResourceEndpoint
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("ResourceEndpointuri")
     */
    private $resourceEndpointuri;
}
