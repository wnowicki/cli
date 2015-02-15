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
 * Class AbstractBox
 *
 * @author WN
 * @package WNowicki\Cli
 */
abstract class AbstractBox extends AbstractContainer
{
    private $rows = [];
    private $pointer = 0;
    private $color;
    private $option;
    private $bgcolor;

    protected function __construct($width, $height, $color = null, $option = null, $bgcolor = null)
    {
        $this->setWidth($width)->setHeight($height);

        $this->color = $color;
        $this->option = $option;
        $this->bgcolor = $bgcolor;

        $this->rows = $this->buildMatrix($width, $height, $color, $option, $bgcolor);
    }

    /**
     * @author WN
     * @param int $width
     * @param int $height
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     * @return Row[]
     */
    protected function buildMatrix($width, $height, $color, $option, $bgcolor)
    {
        $output = [];

        for ($y=0; $y < $height; $y++) {
            $output[] = Row::make($width, $color, $option, $bgcolor);
        }

        return $output;
    }

    /**
     * Reset Box
     *
     * @return $this
     */
    public function reset()
    {
        $this->rows = $this->buildMatrix(
            $this->getWidth(),
            $this->getHeight(),
            $this->color,
            $this->option,
            $this->bgcolor
        );

        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return Row
     */
    public function current()
    {
        return $this->rows[$this->pointer];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->pointer++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return int scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        if (array_key_exists($this->pointer, $this->rows) && $this->rows[$this->pointer] instanceof Row) {

            return true;
        }

        return false;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->pointer = 0;
    }
}
