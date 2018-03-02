<?php



namespace AppBundle\Entity;



/**

 * products

 */

class products

{

    /**

     * @var int

     */

    private $id_product;



    /**

     * @var string

     */

    private $name;



    /**

     * @var string

     */

    private $ref;



    /**

     * @var string

     */

    private $describ;



    /**

     * @var string

     */

    private $feature;



    /**

     * @var string

     */

    private $color;



    /**

     * @var float

     */

    private $weigth;



    /**

     * @var \DateTime

     */

    private $dateCreate;



    /**

     * @var \DateTime

     */

    private $dateModif;



    /**

     * @var float

     */

    private $priceHT;



    /**

     * @var float

     */

    private $priceTTC;



    /**

     * @var int

     */

    private $statutProduct;


    private $quantities;

    private $categories;

    public  function getQuantities(){
        return $this->quantities;
    }
   /* public function getBasketes(){
        return $this->basketes;
    }*/


    public function getCategories()

    {

        return $this->categories;

    }





    /**

     * Get id

     *

     * @return int

     */

    public function getIdProduct()

    {

        return $this->id_product;

    }

    public function getid_product()
    {
      return $this->id_product;

    }


    /**

     * Set name

     *

     * @param string $name

     *

     * @return products

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

     * Set ref

     *

     * @param string $ref

     *

     * @return products

     */

    public function setRef($ref)

    {

        $this->ref = $ref;



        return $this;

    }



    /**

     * Get ref

     *

     * @return string

     */

    public function getRef()

    {

        return $this->ref;

    }



    /**

     * Set describ

     *

     * @param string $describ

     *

     * @return products

     */

    public function setDescrib($describ)

    {

        $this->describ = $describ;



        return $this;

    }



    /**

     * Get describ

     *

     * @return string

     */

    public function getDescrib()

    {

        return $this->describ;

    }



    /**

     * Set feature

     *

     * @param string $feature

     *

     * @return products

     */

    public function setFeature($feature)

    {

        $this->feature = $feature;



        return $this;

    }



    /**

     * Get feature

     *

     * @return string

     */

    public function getFeature()

    {

        return $this->feature;

    }



    /**

     * Set color

     *

     * @param string $color

     *

     * @return products

     */

    public function setColor($color)

    {

        $this->color = $color;



        return $this;

    }



    /**

     * Get color

     *

     * @return string

     */

    public function getColor()

    {

        return $this->color;

    }



    /**

     * Set poid

     *

     * @param integer $poid

     *

     * @return products

     */

    public function setWeigth($poid)

    {

        $this->weigth = $poid;



        return $this;

    }



    /**

     * Get poid

     *

     * @return int

     */

    public function getWeigth()

    {

        return $this->weigth;

    }



    /**

     * Set dateCreate

     *

     * @param \DateTime $dateCreate

     *

     * @return products

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



    /**

     * Set dateModif

     *

     * @param \DateTime $dateModif

     *

     * @return products

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



    /**

     * Set priceHT

     *

     * @param float $priceHT

     *

     * @return products

     */

    public function setPriceHT($priceHT)

    {

        $this->priceHT = $priceHT;



        return $this;

    }



    /**

     * Get priceHT

     *

     * @return float

     */

    public function getPriceHT()

    {

        return $this->priceHT;

    }



    /**

     * Set priceTTC

     *

     * @param float $priceTTC

     *

     * @return products

     */

    public function setPriceTTC($priceTTC)

    {

        $this->priceTTC = $priceTTC;



        return $this;

    }



    /**

     * Get priceTTC

     *

     * @return float

     */

    public function getPriceTTC()

    {

        return $this->priceTTC;

    }



    /**

     * Set statutProduit

     *

     * @param integer $statutProduct

     *

     * @return products

     */

    public function setStatutProduct($statutProduit)

    {

        $this->statutProduct= $statutProduit;



        return $this;

    }



    /**

     * Get statutProduct

     *

     * @return int

     */

    public function getStatutProduct()

    {

        return $this->statutProduct;

    }

}



