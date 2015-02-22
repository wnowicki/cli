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

/**
 * Interface FrameInterface
 *
 * @author WN
 * @package WNowicki\Cli\Sequence
 */
interface FrameInterface
{
    /**
     * Render Frame
     *
     * @author WN
     * @return Screen
     */
    public function render();

    /**
     * Add Screen
     *
     * @author WN
     * @param Screen $screen
     * @return $this
     */
    public function addScreen(Screen $screen);
}
