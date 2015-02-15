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
 * Class Screen
 *
 * @author WN
 * @package WNowicki\Cli
 */
class Screen extends AbstractBox implements ContainerInterface
{
    /**
     * @author WN
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     */
    protected function __construct($color = null, $option = null, $bgcolor = null)
    {
        $width = (int) exec('tput cols');
        $height = (int) exec('tput lines');

        parent::__construct($width, $height, $color, $option, $bgcolor);
    }

    /**
     * Make Screen
     *
     * @author WN
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     * @return Screen
     */
    static public function make($color = null, $option = null, $bgcolor = null)
    {
        return new self($color, $option, $bgcolor);
    }

    /**
     * Renders Screen
     *
     * @author WN
     * @return $this
     */
    public function render()
    {
        self::clear();

        $y = 0;

        foreach ($this as $row) {

            echo $row->render();

            $y++;

            if ($y ==! $this->getHeight()) {
                echo "\n";
            }
        }

        return $this;
    }

    /**
     * Clears Screen
     *
     * @author WN
     */
    public static function clear()
    {
        passthru('clear');
    }
}
