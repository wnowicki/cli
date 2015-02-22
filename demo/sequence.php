<?php

require_once('../vendor/autoload.php');

class Frame1 extends \WNowicki\Cli\Sequence\AbstractFrame implements \WNowicki\Cli\Sequence\FrameInterface
{
    /**
     * Render Frame
     *
     * @author WN
     * @return \WNowicki\Cli\Screen
     */
    public function render()
    {
        $this->getScreen()->putInCenter('Frame 1', 3);
    }
}

class Frame2 extends \WNowicki\Cli\Sequence\AbstractFrame implements \WNowicki\Cli\Sequence\FrameInterface
{
    /**
     * Render Frame
     *
     * @author WN
     * @return \WNowicki\Cli\Screen
     */
    public function render()
    {
        $this->getScreen()->putInCenter('Frame 2', 4);
    }
}

$screen = \WNowicki\Cli\Screen::make();

$sequence = \WNowicki\Cli\Sequence\InfiniteSequence::make();

$sequence->addFrame(Frame1::make())->addFrame(Frame2::make(), 3)->run();
