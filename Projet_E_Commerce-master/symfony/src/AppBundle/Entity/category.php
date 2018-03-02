<?php



namespace AppBundle\Entity;



/**

 * category

 */

class category

{

    /**

     * @var int

     */

    private $id_cat;



    /**

     * @var string

     */

    private $nameCat;



    /**

     * @var string

     */

    private $describ;



    /**

     * @var int

     */

    private $idParent;



    private $products;



    public function getProducts()

    {

        return $this->products;

    }



    /**

     * Get id

     *

     * @return int

     */

    public function getid_cat()

    {

        return $this->id_cat;

    }



    /**

     * Set nameCat

     *

     * @param string $nameCat

     *

     * @return category

     */

    public function setNameCat($nameCat)

    {

        $this->nameCat = $nameCat;



        return $this;

    }



    /**

     * Get nameCat

     *

     * @return string

     */

    public function getNameCat()

    {

        return $this->nameCat;

    }



    /**

     * Set describ

     *

     * @param string $describ

     *

     * @return category

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

     * Set idParent

     *

     * @param integer $idParent

     *

     * @return category

     */

    public function setIdParent($idParent)

    {

        $this->idParent = $idParent;



        return $this;

    }



    /**

     * Get idParent

     *

     * @return int

     */

    public function getIdParent()

    {

        return $this->idParent;

    }

}