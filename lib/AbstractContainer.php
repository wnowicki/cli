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

abstract class AbstractContainer
{
    /** @var ScreenRow[]  */
    protected  $matrix = [];
    protected  $current = 0;
    protected  $rows;
    protected  $cols;
    protected  $fill;

    /**
     * @author WN
     * @param $rows
     * @param $cols
     * @param $fill
     * @return ScreenRow[]
     */
    protected function buildMatrix($rows, $cols, $fill)
    {
        $output = [];

        for ($y=0; $y < $rows; $y++) {
            $output[] = ScreenRow::make($cols, $fill);
        }

        return $output;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return ScreenRow
     */
    public function current()
    {
        if (isset($this->matrix[$this->current])) {
            return $this->matrix[$this->current];
        }
        return null;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->current++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return int
     */
    public function key()
    {
        return $this->current;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        if ($this->current() instanceof ScreenRow) {

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
        $this->current = 0;
    }

    /**
     * Get Number of Rows on Screen
     *
     * @author WN
     * @return int
     */
    public function rows()
    {
        return $this->rows;
    }

    /**
     * Get Number of Columns on Screen
     *
     * @author WN
     * @return int
     */
    public function cols()
    {
        return $this->cols;
    }

    /**
     * Resets Output Buffer
     *
     * @author WN
     * @return $this
     */
    public function reset()
    {
        $this->matrix = $this->buildMatrix($this->rows, $this->cols, $this->fill);

        return $this;
    }
}
