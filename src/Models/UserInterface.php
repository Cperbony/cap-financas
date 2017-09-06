<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 30/08/2017
 * Time: 13:55
 */

namespace CAPFin\Models;


interface UserInterface
{
    public function getId(): int;

    public function getFullName(): string;

    public function getEmail(): string;

    public function getPassword(): string;

}
