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

namespace Panda\Routing\Validators;

use Panda\Http\Request;
use Panda\Routing\Route;

/**
 * Interface ValidatorInterface
 *
 * @package Panda\Routing\Validators
 *
 * @version 0.1
 */
interface ValidatorInterface
{
    /**
     * Validate a given rule against a route and request.
     *
     * @param Route   $route
     * @param Request $request
     *
     * @return bool
     */
    public function matches(Route $route, Request $request);
}
