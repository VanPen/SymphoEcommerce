<?php

namespace AppBundle\Entity;

/**
 * imageProduct
 */
class imageProduct
{
    /**
     * @var int
     */
    private $id_image;

    /**
     * @var string
     */
    private $image;

    /**
     * @var int
     */
    private $idProduct;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdImage()
    {
        return $this->id_image;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return imageProduct
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set idProduct
     *
     * @param integer $idProduct
     *
     * @return imageProduct
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct
     *
     * @return int
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }
}

