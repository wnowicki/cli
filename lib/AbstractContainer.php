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

abstract class AbstractContainer implements ContainerInterface
{
    /** @var Row[]  */
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
     * @return Row[]
     */
    protected function buildMatrix($rows, $cols, $fill)
    {
        $output = [];

        for ($y=0; $y < $rows; $y++) {
            $output[] = Row::make($cols, $fill);
        }

        return $output;
    }

    /**
     * Put String In Container
     *
     * @author WN
     * @param string|Box $element
     * @param int $row
     * @param int $offset
     * @return $this
     */
    public function putIn($element, $row = 0, $offset = 0)
    {
        if ($row < 0) {

            $row = $this->rows + $row;
        }

        if ($element instanceof Box) {

            foreach($element as $content) {
                print_r($row);
                $this->matrix[$row++]->putIn($content->toString(), $offset);
            }

        } else {
            $this->matrix[$row]->putIn($element, $offset);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function width()
    {
        return $this->cols;
    }

    /**
     * @return int
     */
    public function height()
    {
        return $this->rows;
    }

    /**
     * Returns Offset to Place Container in the Center
     *
     * @author WN
     * @param ContainerInterface $container
     * @return float
     */
    public function placeInCenter(ContainerInterface $container)
    {
        return floor(($this->width() - $container->width())/2);
    }

    /**
     * @param ContainerInterface $container
     * @param $columns
     * @param int $column
     * @param bool $center
     * @return int
     */
    public function placeInColumn(ContainerInterface $container, $columns = 1, $column = 0, $center = true)
    {
        $columnSize = $this->width()/$columns;

        return floor($column * $columnSize + ($center?floor(($columnSize - $container->width())/2):0));
    }

    /**
     * Add Simple Border
     *
     * @author WN
     * @param string $fill
     * @return $this
     */
    public function addBorder($fill = '*')
    {
        $box = Box::make($this->width(), 1, $fill);
        $this->putIn($box, 0, 0)->putIn($box, $this->height()-1, 0);

        $box = Box::make(1, $this->height(), $fill);
        $this->putIn($box, 0, 0)->putIn($box, 0, $this->width()-1);

        return $this;
    }

    public function addTitle($title, $size = 0, $border = '*')
    {
        $string = Text::make($title);

        $box = Box::make($this->width(), $size*2+3)->addBorder($border);
        $box->putIn($string, $size+1, $box->placeInCenter($string));

        return $this->putIn($box);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return Row
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
        if ($this->current() instanceof Row) {

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
