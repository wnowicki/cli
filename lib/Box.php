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
 * Class Box
 *
 * @author WN
 * @package WNowicki\Cli
 */
class Box extends AbstractBox implements ContainerInterface
{
    /**
     * @param int $width
     * @param int $height
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     * @return Box
     */
    static public function make($width, $height, $color = null, $option = null, $bgcolor = null)
    {
        return new static($width, $height, $color, $option, $bgcolor);
    }
}
