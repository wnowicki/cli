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
        return new self($width, $height, $color, $option, $bgcolor);
    }

    public static function makeFromString($string, $color = null, $option = null, $bgcolor = null)
    {
        if (!is_string($string)) {

            throw new \InvalidArgumentException('Argument must be string');
        }

        $ar = explode("\n", $string);

        $height = count($ar);
        $width = strlen(max($ar));

        $obj = new self($width, $height, $color, $option, $bgcolor);

        $i = 0;

        foreach ($obj as $row) {

            $row->put(Row::makeFromString($ar[$i++]), $color, $option, $bgcolor);
        }

        return $obj;
    }
}
