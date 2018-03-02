<?php

namespace AppBundle\Entity;

/**
 * adress
 */
class adress
{
    /**
     * @var int
     */
    private $id_adress;

    /**
     * @var string
     */
    private $nameAdress;

    /**
     * @var string
     */
    private $nameDesti;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var int
     */
    private $cp;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var \DateTime
     */
    private $dateCreate;
    /**
     * @var int
     */
    private $visible;

    private $Orders;

    public function getOrders(){
        return $this->Orders;
    }

    public function getVisible(){
        return $this->visible;
    }
    public function setVisible($int){
        $this->visible = $int;
    }

    private $user;


    public function __construct()
    {
        $this->setDateCreate(new \DateTime('NOW'));
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getIdAdress()
    {
        return $this->id_adress;
    }

    /**
     * Get user
     *
     */
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }
    /**
     * Set nameAdress
     *
     * @param string $nameAdress
     *
     * @return adress
     */
    public function setNameAdress($nameAdress)
    {
        $this->nameAdress = $nameAdress;

        return $this;
    }

    /**
     * Get nameAdress
     *
     * @return string
     */
    public function getNameAdress()
    {
        return $this->nameAdress;
    }

    /**
     * Set nameDesti
     *
     * @param string $nameDesti
     *
     * @return adress
     */
    public function setNameDesti($nameDesti)
    {
        $this->nameDesti = $nameDesti;

        return $this;
    }

    /**
     * Get nameDesti
     *
     * @return string
     */
    public function getNameDesti()
    {
        return $this->nameDesti;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return adress
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return int
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return adress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return adress
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return adress
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }
}

