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

namespace Panda\Foundation\Init;

use Panda\Contracts\Init\Initializer;
use Panda\Foundation\Application;
use Panda\Http\Request;

/**
 * Environment Initializer
 * Initialize session, datetimer and debugger.
 *
 * @package Panda\Session
 * @version 0.1
 */
class Environment implements Initializer
{
    /**
     * @type Application
     */
    private $app;

    /**
     * Environment constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Run the initializer.
     *
     * @param Request $request
     */
    public function init($request)
    {
        $this->app->make('\Panda\Debug\Debugger')->init($request);
        $this->app->make('\Panda\Localization\DateTimer')->init($request);
        $this->app->make('\Panda\Session\Session')->init($request);
    }
}