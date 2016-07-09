<?php

/*
 * This file is part of the Panda framework.
 *
 * (c) Ioannis Papikas <papikas.ioan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Panda\Foundation\Bootstrap;

use Panda\Contracts\Bootstrapper;
use Panda\Foundation\Application;
use Panda\Http\Request;
use Panda\Support\Facades\Facade;

/**
 * Class FacadeRegistry
 *
 * @package Panda\Foundation\Bootstrap
 *
 * @version 0.1
 */
class FacadeRegistry implements Bootstrapper
{
    /**
     * @var Application
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
    public function boot($request)
    {
        // Set facade application container
        Facade::setFacadeApp($this->app);
    }
}
