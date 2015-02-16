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
 * Class Char
 *
 * @author WN
 * @package WNowicki\Cli
 */
class Char
{
    const RESET = "\033[0m";

    private $content = null;
    private $color = null;
    private $bgcolor = null;
    private $option = null;
    private $default;

    const BOLD = 1;
    const UNDERSCORE = 4;
    const BLINK = 5;
    const REVERSE = 7;
    const CONCEAL = 8;

    private function __construct()
    {
    }

    /**
     * @author WN
     * @param string|null $content
     * @param int|null $color
     * @param int|null $option
     * @param int|null $bgcolor
     * @return Char
     */
    public static function make($content = null, $color = null, $option = null, $bgcolor = null, $default = null)
    {
        $obj = new self($content);

        if ($content !== null) {
            $obj->setContent($content);
        }

        if ($color !== null) {
            $obj->setColor($color);
        }

        if ($bgcolor !== null) {
            $obj->setBgcolor($bgcolor);
        }

        $obj->setDefault($default);

        return $obj;
    }

    /**
     * @author WN
     * @param Char $char
     * @return $this
     */
    public function inherit(Char $char)
    {
        if ($char->getContent() !== null) {
            $this->setContent($char->getContent());
        }

        if ($char->getColor() !== null) {
            $this->setColor($char->getColor());
        }

        if ($char->getBgcolor() !== null) {
            $this->setBgcolor($char->getBgcolor());
        }

        if ($char->getDefault() !== null) {
            $this->setDefault($char->getDefault());
        }

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $string = $this->getContent();

        if ($string === null) {

            $string = $this->getDefault();
        }

        if ($this->getBgcolor() !== null) {

            $string = "\033[" . $this->getBgcolor() . 'm' . $string;

        }

        if ($this->getColor() !== null || $this->getOption() !== null) {

            if ($this->getColor() === null) {
                $this->setColor(Color::COLOR_BLACK);
            }

            if ($this->getOption() === null) {
                $this->option = 0;
            }

            $string = "\033[" . $this->getOption() . ';' . $this->getColor() . 'm' . $string;

        }

        if ($this->getColor() !== null || $this->getOption() !== null || $this->getBgcolor() !== null) {

            $string = $string . self::RESET;
        }

        return $string;
    }

    /**
     * @author WN
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @author WN
     * @return int|null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @author WN
     * @return int|null
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * @author WN
     * @return int|null
     */
    public function getOption()
    {
        return null;
    }

    /**
     * @author WN
     * @param string $content
     * @return $this
     */
    private function setContent($content)
    {
        if (!is_string($content)) {

            throw new \InvalidArgumentException('Argument must be a string');
        }

        if (strlen($content) > 1) {

            throw new \InvalidArgumentException('Content length must not be greater than one');
        }

        $this->content = $content;
        return $this;
    }

    /**
     * @author WN
     * @param int $color
     * @return $this
     */
    private function setColor($color)
    {
        if (!Color::isValidColor($color)) {

            throw new \InvalidArgumentException('Invalid color argument');
        }

        $this->color = $color;
        return $this;
    }

    /**
     * @author WN
     * @param int $bgcolor
     * @return $this
     */
    private function setBgcolor($bgcolor)
    {
        if (!Color::isValidBackgroundColor($bgcolor)) {

            throw new \InvalidArgumentException('Invalid background color argument');
        }

        $this->bgcolor = $bgcolor;
        return $this;
    }

    /**
     * @author WN
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @author WN
     * @param string $default
     * @return $this
     */
    private function setDefault($default)
    {
        if ($default === null) {

            $default = ' ';
        }

        if (!is_string($default)) {

            throw new \InvalidArgumentException('Argument must be a string');
        }

        if (strlen($default) != 1) {

            throw new \InvalidArgumentException('Default length must not be greater than one');
        }

        $this->default = $default;
        return $this;
    }
}
