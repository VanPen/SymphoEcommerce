<?php

namespace AppBundle\Entity;

/**
 * Visit
 */
class Visit
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $adressIp;

    /**
     * @var string
     */
    private $agentClient;

    /**
     * @var \DateTime
     */
    private $lastConnection;


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
     * Set adressIp
     *
     * @param string $adressIp
     *
     * @return Visit
     */
    public function setAdressIp($adressIp)
    {
        $this->adressIp = $adressIp;

        return $this;
    }

    /**
     * Get adressIp
     *
     * @return string
     */
    public function getAdressIp()
    {
        return $this->adressIp;
    }

    /**
     * Set agentClient
     *
     * @param string $agentClient
     *
     * @return Visit
     */
    public function setAgentClient($agentClient)
    {
        $this->agentClient = $agentClient;

        return $this;
    }

    /**
     * Get agentClient
     *
     * @return string
     */
    public function getAgentClient()
    {
        return $this->agentClient;
    }

    /**
     * Set lastConnection
     *
     * @param \DateTime $lastConnection
     *
     * @return Visit
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }

    /**
     * Get lastConnection
     *
     * @return \DateTime
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }
}

