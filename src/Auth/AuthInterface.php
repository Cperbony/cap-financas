<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 29/08/2017
 * Time: 14:35
 */
declare(strict_types=1);

namespace CAPFin\Auth;

use CAPFin\Models\UserInterface;

interface AuthInterface
{
    public function login(array $credentials): bool;

    public function check(): bool;

    public function logout(): void;

    public function hashPassword(string $password): string;

    public function user(): ?UserInterface;

}

