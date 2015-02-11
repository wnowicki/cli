<?php
/*
 * This file is part of the WNowicki/Cli package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WNowicki\Cli;

/**
 * Interface ContainerInterface
 *
 * @author WN
 * @package WNowicki\Cli
 */
interface ContainerInterface
{
    /**
     * Container Width
     *
     * @return int
     */
    public function width();

    /**
     * Container Height
     *
     * @return int
     */
    public function height();
}
