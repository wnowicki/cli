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
 * Class AbstractContainer
 *
 * @author WN
 * @package WNowicki\Cli
 */
abstract class AbstractContainer implements ContainerInterface
{
    private $width;
    private $height;

    /**
     * Get Container Width
     *
     * @author WN
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set Container Width
     *
     * @author WN
     * @param int $width
     * @return $this
     */
    protected function setWidth($width)
    {
        if (!is_numeric($width)) {

            throw new \InvalidArgumentException('Width must be numeric value!');
        }

        $this->width = (int) $width;
        return $this;
    }

    /**
     * Get Container Height
     *
     * @author WN
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set Container Height
     *
     * @author WN
     * @param int $height
     * @return $this
     */
    protected function setHeight($height)
    {
        if (!is_numeric($height)) {

            throw new \InvalidArgumentException('Height must be numeric value!');
        }

        $this->height = (int) $height;
        return $this;
    }
}
