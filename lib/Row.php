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
class Row
{
    private $vector = [];
    private $fill;
    private $length;

    /**
     * @author WN
     * @param $length
     * @param string $fill
     * @throws \Exception
     */
    public function __construct($length, $fill = ' ')
    {
        if (strlen($fill) !== 1) {

            throw new \Exception('');
        }

        $this->fill = $fill;
        $this->length = $length;

        $this->vector = $this->buildVector($this->length, $this->fill);
    }

    /**
     * @author WN
     * @param $length
     * @param string $fill
     * @return Row
     */
    public static function make($length, $fill = ' ')
    {
        return new Row($length, $fill);
    }

    /**
     * @author WN
     * @param $length
     * @param $fill
     * @return array
     */
    private function buildVector($length, $fill)
    {
        $output = [];

        for ($i=0; $i < $length; $i++) {
            $output[] = $fill;
        }

        return $output;
    }

    /**
     * Put String In Row
     *
     * @author WN
     * @param string $string
     * @param int $offset
     * @return $this
     */
    function putIn($string, $offset = 0)
    {

        if ($offset < 0) {
            $offset = $this->length + $offset;
        }

        if (is_string($string)) {
            $string = str_split($string);
        }

        foreach ($string as $pixel) {

            if ($offset == $this->length) {
                break;
            }

            $this->vector[$offset] = $pixel;
            $offset++;
        }

        return $this;
    }

    /**
     * Returns Row as a String
     *
     * @author WN
     * @return string
     */
    public function toString()
    {
        return (string) implode($this->vector);
    }
}
