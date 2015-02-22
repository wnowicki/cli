<?php
/*
 * This file is part of the WNowicki/Cli package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WNowicki\Cli\Sequence;

use WNowicki\Cli\Screen;

abstract class AbstractFrame
{
    private $screen;

    /**
     * Make Frame
     *
     * @author WN
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * Add Screen
     *
     * @author WN
     * @param Screen $screen
     * @return $this
     */
    public function addScreen(Screen $screen)
    {
        $this->screen = $screen;
        return $this;
    }

    /**
     * Get Screen
     *
     * @author WN
     * @return Screen
     */
    protected function getScreen()
    {
        return $this->screen;
    }
}
