<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 29/08/2017
 * Time: 14:50
 */

namespace CAPFin\Auth;


use CAPFin\Repository\RepositoryInterface;
use Jasny\Auth;
use Jasny\Auth\Sessions;
use Jasny\Auth\User;

class JasnyAuth extends Auth
{
    use Sessions;
    /**
     * @var RepositoryInterface
     */
    private $repository;


    /**
     * JasnyAuth constructor.
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    /**
     * Fetch a user by ID
     *
     * @param  int|string $id
     * @return User|null
     */
    public function fetchUserById($id)
    {
        return $this->repository->find($id, false);
    }

    /**
     * Fetch a user by username
     *
     * @param  string $username
     * @return User|null
     */
    public function fetchUserByUsername($username)
    {
        return $this->repository->findByField('email', $username)[0];
    }
}
