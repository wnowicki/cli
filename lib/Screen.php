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
class Screen extends AbstractContainer implements \Iterator
{
    /**
     * @author WN
     * @param string $fill
     */
    public function __construct($fill = ' ')
    {
        $this->fill = $fill;

        $this->rows = (int) exec('tput lines');
        $this->cols = (int) exec('tput cols');

        $this->matrix = $this->buildMatrix($this->rows, $this->cols, $fill);
    }

    /**
     * @author WN
     * @param string $fill
     * @return Screen
     */
    public static function make($fill = ' ')
    {
        return new self($fill);
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

        foreach ($this->matrix as $row) {

            echo $row->toString();

            $y++;

            if ($y ==! $this->rows) {
                echo "\n";
            }
        }

        return $this;
    }

    /**
     * Put String In Screen
     *
     * @author WN
     * @param string $string
     * @param int $row
     * @param int $offset
     * @return $this
     */
    public function putIn($string, $row = 0, $offset = 0)
    {
        if ($row < 0) {

            $row = $this->rows + $row;
        }

        if ($string instanceof Box) {

            foreach($string as $content) {
                $this->matrix[$row++]->putIn($content->toString(), $offset);
            }

        } else {
            $this->matrix[$row]->putIn($string, $offset);
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
