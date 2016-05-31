<?php

/*
 * This file is part of the Panda framework.
 *
 * (c) Ioannis Papikas <papikas.ioan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Panda\Foundation;

use Panda\Container\Container;
use Panda\Contracts\Http\Kernel as KernelInterface;
use Panda\Foundation\Http\Kernel;
use Panda\Http\Request;

/**
 * Panda application manager.
 *
 * @package Panda\Foundation
 * @version 0.1
 */
class Application extends Container
{
    /**
     * The application's base path.
     *
     * @type string
     */
    protected $basePath;

    /**
     * @type Application
     */
    protected static $app;

    /**
     * Create a new panda application instance.
     *
     * @param string $basePath
     */
    public function __construct($basePath = null)
    {
        // Construct container
        parent::__construct();

        // Set application
        static::setApp($this);

        // Set object properties
        if (!empty($basePath)) {
            $this->setBasePath($basePath);
        }

        // Register all bindings
        $this->registerAppBindings();
        $this->registerServiceBindings();
    }

    /**
     * Register application bindings.
     */
    private function registerAppBindings()
    {
        // Load config from .json file
        $config = array();

        // Add container definitions
        //$this->addDefinitions($config);

        // Set container
        $this->set('app', $this);
        $this->set('Panda\Foundation\Application', $this);
        $this->set('Panda\Container\Container', $this);
    }

    /**
     * Register service bindings.
     */
    private function registerServiceBindings()
    {
        // Set container interfaces (manually, to be removed)
        $this->set(KernelInterface::class, \DI\object(Kernel::class));
    }

    /**
     * @return Application
     */
    public static function getApp()
    {
        return static::$app;
    }

    /**
     * @param Application $app
     */
    public static function setApp($app)
    {
        static::$app = $app;
    }

    /**
     * Initialize the framework with the given initializers.
     *
     * @param array   $initializers
     * @param Request $request
     */
    public function init($initializers, Request $request)
    {
        // Initialize all needed
        foreach ($initializers as $initializer) {
            $this->make($initializer)->init($request);
        }
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getConfigPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . "config";
    }

    /**
     * @return string
     */
    public function getRoutesPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "routes" . DIRECTORY_SEPARATOR . "main.php";
    }

    /**
     * @return string
     */
    public function getViewsPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views";
    }
}

?>