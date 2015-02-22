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

/**
 * Class InfiniteSequence
 *
 * @author WN
 * @package WNowicki\Cli\Sequence
 */
class InfiniteSequence extends Sequence
{
    /**
     * Run Sequence
     *
     * @author WN
     */
    public function run()
    {
        while (true) {
            parent::run();
        }
    }
}
