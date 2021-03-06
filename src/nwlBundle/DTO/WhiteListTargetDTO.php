<?php
/**
 * Created by PhpStorm.
 * User: 67521
 * Date: 25.07.2016
 * Time: 15:48
 */

namespace nwlBundle\DTO;


use nwlBundle\Entity\User;
use nwlBundle\Entity\WhiteListRequest;

class WhiteListTargetDTO
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $domain;

    /**
     * @var int
     */
    private $state;

    /**
     * @var User
     */
    private $decidedBy;
    /**
     * @var WhiteListRequest[]
     */
    private $whitelistRequests;
    /**
     * @var \DateTime
     */
    private $decisionDate;

    /**
     * @return mixed
     */
    public function getDecisionDate()
    {
        return $this->decisionDate;
    }

    /**
     * @param mixed $decisionDate
     */
    public function setDecisionDate($decisionDate)
    {
        $this->decisionDate = $decisionDate;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return User
     */
    public function getDecidedBy()
    {
        return $this->decidedBy;
    }

    /**
     * @param User $decidedBy
     */
    public function setDecidedBy($decidedBy)
    {
        $this->decidedBy = $decidedBy;
    }

    /**
     * @return mixed
     */
    public function getWhitelistRequests()
    {
        return $this->whitelistRequests;
    }

    /**
     * @param mixed $whitelistRequests
     */
    public function setWhitelistRequests($whitelistRequests)
    {
        $this->whitelistRequests = $whitelistRequests;
    }
}