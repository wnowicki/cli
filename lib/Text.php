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
 * Class Text
 *
 * @author WN
 * @package WNowicki\Cli
 */
class Text implements \Iterator
{
    const RESET = "\033[0m";

    const COLOR_BLACK = 30;
    const COLOR_RED = 31;
    const COLOR_GREEN = 32;
    const COLOR_YELLOW = 33;
    const COLOR_BLUE = 34;
    const COLOR_MAGENTA = 35;
    const COLOR_CYAN = 36;
    const COLOR_WHITE = 37;

    const BOLD = 1;
    const UNDERSCORE = 4;
    const BLINK = 5;
    const REVERSE = 7;
    const CONCEAL = 8;

    const BG_BLACK = 40;
    const BG_RED = 41;
    const BG_GREEN = 42;
    const BG_YELLOW = 43;
    const BG_BLUE = 44;
    const BG_MAGENTA = 45;
    const BG_CYAN = 46;
    const BG_WHITE = 47;

    private $string;
    private $current = 0;
    private $color;
    private $option;
    private $background;

    /**
     * @author WN
     * @param $string
     * @param null $color
     * @param null $option
     * @param null $background
     */
    public function __construct($string, $color = null, $option = null, $background = null)
    {
        $this->string = $string;
        $this->color = $color;
        $this->option = $option;
        $this->background = $background;
    }

    /**
     * Make Text Object
     *
     * @author WN
     * @param string $string
     * @param int|null $color
     * @param int|null $option
     * @param int|null $background
     * @return Text
     */
    public static function make($string, $color = null, $option = null, $background = null)
    {
        return new self($string, $color, $option, $background);
    }

    /**
     * Get Modified String
     *
     * @author WN
     * @param $string
     * @param int|null $color
     * @param int|null $option
     * @param int|null $background
     * @return string
     */
    public static function get($string, $color = null, $option = null, $background = null)
    {
        $obj = new self($string, $color, $option, $background);

        return $obj->getString();
    }

    /**
     * @author WN
     * @param string $string
     * @return string
     */
    private function render($string)
    {
        if ($this->background !== null) {

            $string = "\033[" . $this->background . 'm' . $string;

        }

        if ($this->color !== null || $this->option !== null) {

            if ($this->color === null) {
                $this->color = self::COLOR_BLACK;
            }

            if ($this->option === null) {
                $this->option = 0;
            }

            $string = "\033[" . $this->option . ';' . $this->color . 'm' . $string;

        }

        if ($this->color !== null || $this->option !== null || $this->background !== null) {

            $string = $string . self::RESET;
        }

        return $string;
    }

    /**
     * Get Modified String
     *
     * @author WN
     * @return string
     */
    public function getString()
    {
        return $this->render($this->string);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return string
     */
    public function current()
    {
        return $this->render($this->string[$this->current]);
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
        if (isset($this->string[$this->current]) &&
            !empty($this->string[$this->current]) &&
            is_string($this->string[$this->current])
        ) {
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
