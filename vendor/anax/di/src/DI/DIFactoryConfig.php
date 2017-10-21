<?php

namespace Anax\DI;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\Configure2Trait;

/**
 * DI factory class creating a set of default services by loading
 * them from a configuration file.
 */
class DIFactoryConfig extends DI implements ConfigureInterface
{
    use Configure2Trait {
        configure as protected configure2;
    }



    /**
     * Constructor optionally creating a set of services from a configuration
     * file.
     *
     * @todo Remove $configFile as argument and force using method configure()
     *
     * @param array|string|null $what is an array with key/value
     *                                config options or a file to
     *                                be included which returns such
     *                                an array.
     */
    public function __construct($what = null)
    {
        if (!is_null($what)) {
            $this->configure($what);
        }
    }



    /**
     * Set a configuration object to use, this object have the ability to
     * load configuration from an array or files.
     *
     * @param array|string $what is an array with key/value config options
     *                           or a file to be included which returns such
     *                           an array.
     *
     * @return self
     */
    public function configure($what)
    {
        $this->configure2($what);

        $services = $this->getConfig("services", []);
        foreach ($services as $name => $service) {
            $this->createService($name, $service);
        }

        $items = $this->getConfig("items", []);
        foreach ($items as $config) {
            if (isset($config["services"])) {
                foreach ($config["services"] as $name => $service) {
                    $this->createService($name, $service);
                }
            }
        }

        return $this;
    }



    /**
     * Create a service from a name and an array containing details on how to
     * create it.
     *
     * @param string $name    of service.
     * @param array  $service details to use when creating the service.
     *
     * @return self
     */
    protected function createService($name, $service)
    {
        if (isset($service["shared"]) && $service["shared"]) {
            $this->setShared($name, $service["callback"]);
        } else {
            $this->set($name, $service["callback"]);
        }

        if (isset($service["active"]) && $service["active"]) {
            $this->get($name);
        }

        return $this;
    }
}
