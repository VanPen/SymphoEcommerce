<?php

namespace AppBundle\Entity;

/**
 * ProductToBasket
 */
class ProductToBasket
{
    /**
     * @var int
     */
    private $id_product_basket;

    /**
     * @var int
     */
    private $idBasket;

    /**
     * @var int
     */
    private $idProduct;

    /**
     * @var int
     */
    private $quantity;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdProductBasket()
    {
        return $this->id_product_basket;
    }

    /**
     * Set idBasket
     *
     * @param integer $idBasket
     *
     * @return ProductToBasket
     */
    public function setIdBasket($idBasket)
    {
        $this->idBasket = $idBasket;

        return $this;
    }

    /**
     * Get idBasket
     *
     * @return int
     */
    public function getIdBasket()
    {
        return $this->idBasket;
    }

    /**
     * Set idProduct
     *
     * @param integer $idProduct
     *
     * @return ProductToBasket
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ProductToBasket
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}

