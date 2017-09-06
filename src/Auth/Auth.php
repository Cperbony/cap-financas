<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 29/08/2017
 * Time: 14:37
 */

namespace CAPFin\Auth;


use CAPFin\Models\UserInterface;


class Auth implements AuthInterface
{
    /**
     * @var JasnyAuth
     */
    private $jasnyAuth;


    /**
     * Auth constructor.
     *
     * @param JasnyAuth $jasnyAuth
     */
    public function __construct(JasnyAuth $jasnyAuth)
    {
        $this->jasnyAuth = $jasnyAuth;
        $this->sessionStart();
    }

    /**
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool
    {
        list('email' => $email, 'password' => $password) = $credentials;
        return $this->jasnyAuth->login($email, $password) !== null;
    }

    public function check(): bool
    {
        return $this->user() !== null;
    }

    public function logout(): void
    {
        $this->jasnyAuth->logout();
    }


    /**
     * @return UserInterface
     */
    public function user(): ?UserInterface
    {
        return $this->jasnyAuth->user();
    }


    public function hashPassword(string $password): string
    {
        return $this->jasnyAuth->hashPassword($password);
    }

    protected function sessionStart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
