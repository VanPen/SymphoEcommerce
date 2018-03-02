<?php

namespace AppBundle\Entity;

/**
 * stock
 */
class stock
{
    /**
     * @var int
     */
    private $id_stock;

    /**
     * @var int
     */
    private $idProduct;

    /**
     * @var int
     */
    private $stock;

    /**
     * @var \DateTime
     */
    private $dateModif;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdStock()
    {
        return $this->id_stock;
    }

    /**
     * Set idProduct
     *
     * @param integer $idProduct
     *
     * @return stock
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

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return stock
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }
}

