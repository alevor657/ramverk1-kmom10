<?php

namespace Anax\DI;

/**
 * DI factory class creating a set of default services into the DI container.
 */
class DIFactoryTest extends DIFactoryConfig
{
    use DIServiceSetBaseTrait;



   /**
     * Constructor creating a set of services included into this DI container.
     */
    public function __construct()
    {
        $this->createDefaultServices();
    }
}
