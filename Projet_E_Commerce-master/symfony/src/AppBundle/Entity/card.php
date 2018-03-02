<?php

namespace AppBundle\Entity;

/**
 * card
 */
class card
{
    /**
     * @var int
     */
    private $id_card;

    /**
     * @var int
     */
    private $idUser;

    /**
     * @var string
     */
    private $numberCard;

    /**
     * @var string
     */
    private $nameUserCard;

    /**
     * @var string
     */
    private $dateExpir;

    /**
     * Get id
     *
     * @return int
     */
    public function getIdCard()
    {
        return $this->id_card;
    }
    private $user;

    public function setUser($user){
        $this->user = $user;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return card
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
     * Set numberCard
     *
     * @param string $numberCard
     *
     * @return card
     */
    public function setNumberCard($numberCard)
    {
        $this->numberCard = $numberCard;

        return $this;
    }

    /**
     * Get numberCard
     *
     * @return string
     */
    public function getNumberCard()
    {
        return $this->numberCard;
    }

    /**
     * Set nameUserCard
     *
     * @param string $nameUserCard
     *
     * @return card
     */
    public function setNameUserCard($nameUserCard)
    {
        $this->nameUserCard = $nameUserCard;

        return $this;
    }

    /**
     * Get nameUserCard
     *
     * @return string
     */
    public function getNameUserCard()
    {
        return $this->nameUserCard;
    }

    /**
     * Set dateExpir
     *
     * @param string $dateExpir
     *
     * @return card
     */
    public function setDateExpir($dateExpir)
    {
        $this->dateExpir = $dateExpir;

        return $this;
    }

    /**
     * Get dateExpir
     *
     * @return string
     */
    public function getDateExpir()
    {
        return $this->dateExpir;
    }
}

