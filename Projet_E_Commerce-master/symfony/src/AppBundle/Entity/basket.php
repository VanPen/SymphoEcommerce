<?php

namespace AppBundle\Entity;

/**
 * basket
 */
class basket
{
    /**
     * @var int
     */
    private $id_basket;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $productNumbers;

    /**
     * @var float
     */
    private $totalHT;

    /**
     * @var float
     */
    private $totalTTC;

    /**
     * @var float
     */
    private $totalWeight;

    /**
     * @var int
     */
    private $statusBasket;

    private $user;

    private $quantities;

    private $Orders;

    public function getOrders(){
        $this->Orders;
    }

    public  function setUser($user){
        $this->user = $user;
    }
    public function getUser(){
        return $this->user;
    }
    public function setQuantities($prod){
        $this->quantities = $prod;
    }
    public function getQuantities(){
        return $this->quantities;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getIdBasket()
    {
        return $this->id_basket;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return basket
     */
    public function setUserId($idUser)
    {
        $this->userId = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set productNumbers
     *
     * @param integer $productNumbers
     *
     * @return basket
     */
    public function setProductNumbers($productNumbers)
    {
        $this->productNumbers = $productNumbers;

        return $this;
    }

    /**
     * Get productNumbers
     *
     * @return int
     */
    public function getProductNumbers()
    {
        return $this->productNumbers;
    }

    /**
     * Set totalHT
     *
     * @param float $totalHT
     *
     * @return basket
     */
    public function setTotalHT($totalHT)
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    /**
     * Get totalHT
     *
     * @return float
     */
    public function getTotalHT()
    {
        return $this->totalHT;
    }

    /**
     * Set totalTTC
     *
     * @param float $totalTTC
     *
     * @return basket
     */
    public function setTotalTTC($totalTTC)
    {
        $this->totalTTC = $totalTTC;

        return $this;
    }

    /**
     * Get totalTTC
     *
     * @return float
     */
    public function getTotalTTC()
    {
        return $this->totalTTC;
    }

    /**
     * Set totalWeight
     *
     * @param float $totalWeight
     *
     * @return basket
     */
    public function setTotalWeight($totalWeight)
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }

    /**
     * Get totalWeight
     *
     * @return float
     */
    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    /**
     * Set statusBasket
     *
     * @param integer $statusBasket
     *
     * @return basket
     */
    public function setStatusBasket($statusBasket)
    {
        $this->statusBasket = $statusBasket;

        return $this;
    }

    /**
     * Get statusBasket
     *
     * @return int
     */
    public function getStatusBasket()
    {
        return $this->statusBasket;
    }
}

