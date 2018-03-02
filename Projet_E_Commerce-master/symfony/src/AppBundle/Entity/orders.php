<?php

namespace AppBundle\Entity;

/**
 * orders
 */
class orders
{
    /**
     * @var int
     */
    private $id_order;

    /**
     * @var int
     */
    private $idUser;

    /**
     * @var int
     */
    private $orderStatus;

    /**
     * @var float
     */
    private $totalTTC;

    /**
     * @var float
     */
    private $totalHT;

    /**
     * @var int
     */
    private $nbProduct;

    /**
     * @var float
     */
    private $totalWeight;

    /**
     * @var \DateTime
     */
    private $dateOrder;

    /**
     * @var int
     */
    private $idAdress;

    private $adresses;

    private $user;

    private $basketId;

    private $basketes;

    public function setBasketes($basket){
        $this->basketes = $basket;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function setAdresses($adress){
        $this->adresses = $adress;
    }

    public function getBasketes(){
        return $this->basketes;
    }

    public function getBasketId(){
        return $this->basketId;
    }

    public function getUser(){
        return $this->user;
    }

    public function getAdresses(){
        return $this->adresses;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getIdOrder()
    {
        return $this->id_order;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return orders
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set orderStatus
     *
     * @param integer $orderStatus
     *
     * @return orders
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return int
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set totalTTC
     *
     * @param float $totalTTC
     *
     * @return orders
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
     * Set totalHT
     *
     * @param float $totalHT
     *
     * @return orders
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
     * Set nbProduct
     *
     * @param integer $nbProduct
     *
     * @return orders
     */
    public function setNbProduct($nbProduct)
    {
        $this->nbProduct = $nbProduct;

        return $this;
    }

    /**
     * Get nbProduct
     *
     * @return int
     */
    public function getNbProduct()
    {
        return $this->nbProduct;
    }

    /**
     * Set totalWeight
     *
     * @param float $totalWeight
     *
     * @return orders
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
     * Set dateOrder
     *
     * @param \DateTime $dateOrder
     *
     * @return orders
     */
    public function setDateOrder($dateOrder)
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    /**
     * Get dateOrder
     *
     * @return \DateTime
     */
    public function getDateOrder()
    {
        return $this->dateOrder;
    }

    /**
     * Set idAdress
     *
     * @param integer $idAdress
     *
     * @return orders
     */
    public function setIdAdress($idAdress)
    {
        $this->idAdress = $idAdress;

        return $this;
    }

    /**
     * Get idAdress
     *
     * @return int
     */
    public function getIdAdress()
    {
        return $this->idAdress;
    }
}

