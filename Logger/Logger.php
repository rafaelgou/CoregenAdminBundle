<?php

namespace Coregen\AdminBundle\Logger;

use Coregen\AdminBundle\Entity\Log;
use Coregen\AdminBundle\Entity\User;
use Gpupo\CamelSpiderBundle\Entity\Subscription;
//use Doctrine\ORM\EntityManager;

/**
 * Coregen Logger Service
 *
 * @author Rafael Goulart <rafaelgou@gmail.com>
 */
class Logger
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    protected $security_context;

    /**
     * Constructor
     *
     * @param object $doctrine Doctrine Service Instance
     */
    public function __construct($doctrine, $security_context)
    {
        $this->em = $doctrine->getEntityManager();
        $this->security_context = $security_context;
    }

    /**
     * doLog
     *
     * @param string $type    Type of log message
     * @param string $message The message
     * @param mixed  $user    Optional User instance, null ou 'me' (string), for get current user instance
     *
     * @return void
     */
    public function doLog($type, $message, $user=null, $subscription=null)
    {
        if (strtolower($user) == 'me') {
            $user = $this->security_context->getToken()->getUser();
        }
        if (null !== $user && !$user instanceof User) {
            throw new Exception('Third option must be null or instance of Coregen\AdminBundle\Entity\User');
        }
        if (null !== $subscription && !$subscription instanceof Subscription) {
            throw new Exception('Fourth option must be null or instance of Gpupo\CamelSpiderBundle\Entity\Subscription');
        }
        $log = new Log;
        $log->setCreatedAt(new \DateTime("now"));
        $log->setType($type);
        $log->setMessage($message);
        if (null !== $user) {
            $log->setUser($user);
        }
        if (null !== $subscription) {
            $log->setSubscription($subscription);
        }
        $this->em->persist($log);
        $this->em->flush();
    }

}
