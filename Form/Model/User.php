<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coregen\AdminBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class User
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\MinLength(5)
     */
    public $username;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\MinLength(10)
     */
    public $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\MinLength(6)
     */
    public $password;

    /**
     * @var boolean
     * @Assert\NotBlank()
     */
    public $enabled;

    /**
     * @var boolean
     * @Assert\NotBlank()
     */
    public $superAdmin;

}
