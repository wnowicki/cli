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
 * Class Color
 *
 * @author WN
 * @package WNowicki\Cli
 */
class Color
{
    const COLOR_BLACK = 30;
    const COLOR_RED = 31;
    const COLOR_GREEN = 32;
    const COLOR_YELLOW = 33;
    const COLOR_BLUE = 34;
    const COLOR_MAGENTA = 35;
    const COLOR_CYAN = 36;
    const COLOR_WHITE = 37;

    const BG_BLACK = 40;
    const BG_RED = 41;
    const BG_GREEN = 42;
    const BG_YELLOW = 43;
    const BG_BLUE = 44;
    const BG_MAGENTA = 45;
    const BG_CYAN = 46;
    const BG_WHITE = 47;

    private static $colors = [
        30 => 'black',
        31 => 'red',
        32 => 'green',
        33 => 'yellow',
        34 => 'blue',
        35 => 'magenta',
        36 => 'cyan',
        37 => 'white',
    ];

    private static $bg_colors = [
        40 => 'black',
        41 => 'red',
        42 => 'green',
        43 => 'yellow',
        44 => 'blue',
        45 => 'magenta',
        46 => 'cyan',
        47 => 'white',
    ];

    /**
     * Is Valid Color
     *
     * @author WN
     * @param int $code
     * @return bool
     */
    public static function isValidColor($code)
    {
        return array_key_exists($code, self::$colors);
    }

    /**
     * Is Valid Background Color
     *
     * @author WN
     * @param int $code
     * @return bool
     */
    public static function isValidBackgroundColor($code)
    {
        return array_key_exists($code, self::$bg_colors);
    }
}
