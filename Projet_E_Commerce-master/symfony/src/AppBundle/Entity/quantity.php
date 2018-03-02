<?php

namespace AppBundle\Entity;

/**
 * quantity
 */
class quantity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quant;


    private $basket;

    private $product;

    public function getBasket(){
        return $this->basket;
    }

    public function getProduct(){
        return $this->product;
    }

    public function setBasket ($bas){
        $this->basket = $bas;
    }
    public function setProduct($productes){
        $this->product = $productes;

    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quant
     *
     * @param integer $quant
     *
     * @return quantity
     */
    public function setQuant($quant)
    {
        $this->quant = $quant;

        return $this;
    }

    /**
     * Get quant
     *
     * @return int
     */
    public function getQuant()
    {
        return $this->quant;
    }

    /**
     * Set productsId
     *
     * @param integer $productsId
     *
     * @return quantity
     */
    public function setProductsId($productsId)
    {
        $this->productsId = $productsId;

        return $this;
    }

    /**
     * Get productsId
     *
     * @return int
     */
    public function getProductsId()
    {
        return $this->productsId;
    }

    /**
     * Set baseketId
     *
     * @param integer $baseketId
     *
     * @return quantity
     */
    public function setBaseketId($baseketId)
    {
        $this->baseketId = $baseketId;

        return $this;
    }

    /**
     * Get baseketId
     *
     * @return int
     */
    public function getBaseketId()
    {
        return $this->baseketId;
    }
}

