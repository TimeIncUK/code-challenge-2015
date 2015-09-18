<?php

namespace TimeInc\CatsVsDogsBundle\Document;

/**
 * Class Animal.
 */
class Animal
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $imageSrc;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getImageSrc()
    {
        return $this->imageSrc;
    }

    /**
     * @param string $imageSrc
     */
    public function setImageSrc($imageSrc)
    {
        $this->imageSrc = $imageSrc;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }
}
