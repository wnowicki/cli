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
 * Class Row
 *
 * @author WN
 * @package WNowicki\Cli
 */
class Row extends AbstractContainer implements ContainerInterface
{
    /**
     * @var Char[]
     */
    private $row = [];
    private $pointer = 0;

    /**
     * @param int $width
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     */
    private function __construct($width, $color = null, $option = null, $bgcolor = null)
    {
        $this->setWidth($width)->setHeight(1);

        $this->row = $this->buildVector($width, $color, $option, $bgcolor);
    }

    /**
     * Make Row
     *
     * @author WN
     * @param $width
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     * @return Row
     */
    public static function make($width, $color = null, $option = null, $bgcolor = null)
    {
        return new self($width, $color, $option, $bgcolor);
    }

    /**
     * Make Row From String
     *
     * @author WN
     * @param string $string
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     * @return Row
     */
    public static function makeFromString($string, $color = null, $option = null, $bgcolor = null)
    {
        if (!is_string($string)) {

            throw new \InvalidArgumentException('Argument must be string');
        }

        $obj = self::make(strlen($string), $color, $option, $bgcolor);

        $i = 0;

        foreach (str_split($string) as $content) {

            $obj->addChar(Char::make($content), $i++);
        }

        return $obj;
    }

    /**
     * Put Row
     *
     * @author WN
     * @param Row $content
     * @param int $offset
     * @return $this
     */
    public function put(Row $content, $offset)
    {
        if ($offset < 0) {

            $offset = $this->getWidth() + $offset;
        }

        if ($offset + $content->getWidth() > $this->getWidth()) {

            throw new \OutOfBoundsException('Row is to long to put in here');
        }

        foreach ($content as $char) {

            $this->row[$offset]->inherit($char);
        }

        return $this;
    }

    /**
     * Render Row
     *
     * @author WN
     * @return string
     */
    public function render()
    {
        $string = '';

        foreach ($this as $char) {

            $string .= $char->render();
        }

        return $string;
    }

    /**
     * Add Char
     *
     * @author WN
     * @param Char $char
     * @param int $offset
     * @return $this
     */
    private function addChar(Char $char, $offset)
    {
        if ($offset > $this->getWidth()) {

            throw new \OutOfBoundsException('');
        }

        $this->row[$offset]->inherit($char);

        return $this;
    }

    /**
     * @author WN
     * @param int $length
     * @param int $color
     * @param int $option
     * @param int $bgcolor
     * @return Char[]
     */
    private function buildVector($length, $color, $option, $bgcolor)
    {
        $output = [];

        for ($i=0; $i < $length; $i++) {
            $output[] = Char::make(null, $color, $option, $bgcolor);
        }

        return $output;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return Char Can return any type.
     */
    public function current()
    {
        return $this->row[$this->pointer];
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
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        if (array_key_exists($this->pointer, $this->row) && $this->row[$this->pointer] instanceof Char) {

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
