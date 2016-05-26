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

namespace Panda\Support\Facades;

use Panda\Foundation\Application;
use RuntimeException;

/**
 * Class Facade
 *
 * @package Panda\Model
 * @version 0.1
 */
abstract class Facade
{
    /**
     * The application instance being facaded.
     *
     * @var Application
     */
    protected static $app;

    /**
     * The resolved object instances.
     *
     * @var array
     */
    protected static $instance;

    /**
     * Get the root object behind the facade.
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeHandler());
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeHandler()
    {
        throw new RuntimeException('Facade does not implement getFacadeHandler method.');
    }

    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string|object $name
     *
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }
        if (isset(static::$instance[$name])) {
            return static::$instance[$name];
        }

        return static::$instance[$name] = static::$app->get($name);
    }

    /**
     * @return Application
     */
    public static function getFacadeApp()
    {
        return static::$app;
    }

    /**
     * @param Application $app
     */
    public static function setFacadeApp($app)
    {
        static::$app = $app;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string $method
     * @param  array  $args
     *
     * @return mixed
     *
     * @throws RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        if (!$instance || empty($instance)) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return call_user_func_array([$instance, $method], $args);
    }
}