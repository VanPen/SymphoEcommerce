<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Datetime;
use FOS\UserBundle\Model\User as FosUser;
/**
 * Users
 *
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class users extends FosUser
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var \DateTime
     */
    protected $dateCreate;

    /**
     * @var \DateTime
     */
    protected $dateModif;

    protected $Orders;

    public function getOrders(){
        return $this->Orders;
    }

    /**
     * @var \DateTime
     */
    protected $birthDate;

    protected $adresses;

    protected $basketes;

    public function getBasketes(){
        return $this->basketes;
    }
    public function getAdresses(){
        return $this->adresses;
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
     * Set name
     *
     * @param string $name
     *
     * @return users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return users
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return users
     */
    public function setDateCreate($dateCreate)
    {

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

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return users
     */
    public function setDateModif($dateModif)
    {
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


    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return users
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    public function __construct()
    {
        $this->dateModif = NEW DateTime('NOW');
        $this->dateCreate = new DateTime('NOW');

        parent::__construct();
    }
    protected $cards;
    public function getCards(){
        return $this->cards;
    }
}


