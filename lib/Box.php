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

class Box extends AbstractContainer implements ContainerInterface, \Iterator
{
    public function __construct($cols, $rows, $fill = ' ')
    {
        $this->rows = $rows;
        $this->cols = $cols;

        $this->matrix = $this->buildMatrix($this->rows(), $this->cols(), $fill);
    }
}
