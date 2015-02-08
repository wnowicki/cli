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
class Screen implements \Iterator
{
    private $rows;
    private $cols;
    private $fill;
    /** @var ScreenRow[]  */
    private $matrix = [];
    private $current = 0;

    /**
     * @author WN
     * @param string $fill
     */
    public function __construct($fill = ' ')
    {
        $this->fill = $fill;

        $this->rows = exec('tput lines');
        $this->cols = exec('tput cols');

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
     * @author WN
     * @param $rows
     * @param $cols
     * @param $fill
     * @return ScreenRow[]
     */
    private function buildMatrix($rows, $cols, $fill)
    {
        $output = [];

        for ($y=0; $y < $rows; $y++) {
            $output[] = ScreenRow::make($cols, $fill);
        }

        return $output;
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

        $this->matrix[$row]->putIn($string, $offset);

        return $this;
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

    /**
     * Clears Screen
     *
     * @author WN
     */
    public static function clear()
    {
        passthru('clear');
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
}
