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

namespace Panda\Contracts\Init;
use Panda\Http\Request;

/**
 * Initializer Interface
 *
 * @version 0.1
 */
interface Initializer
{
    /**
     * Run the initializer.
     *
     * @param Request $request
     */
    public function init(Request $request);
}