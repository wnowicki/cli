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
 * Class Sequence
 *
 * @author WN
 * @package WNowicki\Cli\Sequence
 */
class Sequence
{
    /** @var FrameInterface[]  */
    private $frames = [];
    private $frameRepeat = [];
    private $screen;
    private $interval;

    /**
     * @author WN
     * @param Screen $screen
     * @param int $interval
     */
    protected function __construct(Screen $screen, $interval = 1)
    {
        $this->screen = $screen;
        $this->interval = $interval;
    }

    /**
     * Make Sequence
     *
     * @author WN
     * @param Screen $screen
     * @param int $interval
     * @return Sequence
     */
    public static function make(Screen $screen = null, $interval = 1)
    {
        if ($screen === null) {

            $screen = Screen::make();
        }

        return new static($screen, $interval);
    }

    /**
     * Add Frame to Sequence
     *
     * @author WN
     * @param FrameInterface $frame
     * @param int $repeat
     * @return $this
     */
    public function addFrame(FrameInterface $frame, $repeat = 1)
    {
        $frame->addScreen($this->screen);
        $this->frames[] = $frame;
        $this->frameRepeat[] = $repeat;
        return $this;
    }

    /**
     * Run Sequence
     *
     * @author WN
     */
    public function run()
    {
        foreach ($this->frames as $k => $frame) {

            for ($i=0; $i < $this->frameRepeat[$k]; $i++) {

                $this->screen->reset();

                $frame->render();

                $this->screen->render();

                sleep($this->interval);
            }
        }
    }

    /**
     * Get Screen
     *
     * @author WN
     * @return Screen
     */
    public function getScreen()
    {
        return $this->screen;
    }
}
