<?php

namespace AppBundle\Entity;

/**
 * CatToProduct
 */
class CatToProduct
{
    /**
     * @var int
     */
    private $id_product_cat;

    /**
     * @var int
     */
    private $idCat;

    /**
     * @var int
     */
    private $idProduct;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdProductCat()
    {
        return $this->id_product_cat;
    }

    /**
     * Set idCat
     *
     * @param integer $idCat
     *
     * @return CatToProduct
     */
    public function setIdCat($idCat)
    {
        $this->idCat = $idCat;

        return $this;
    }

    /**
     * Get idCat
     *
     * @return int
     */
    public function getIdCat()
    {
        return $this->idCat;
    }

    /**
     * Set idProduct
     *
     * @param integer $idProduct
     *
     * @return CatToProduct
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

