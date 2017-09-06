<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 23/08/2017
 * Time: 12:23
 */
declare(strict_types = 1);
namespace CAPFin\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser, UserInterface
{
    //Mass Assignment (Atribuição Massiva)
    //Em vez de usar os SETs, pegamos um conjunto de dados e jogamos para o Modelo.
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * Get user id
     *
     * @return int|string
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * Get user's username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * Get user's hashed password
     *
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->password;
    }

    /**
     * Event called on login.
     *
     * @return boolean  false cancels the login
     */
    public function onLogin()
    {
        // TODO: Implement onLogin() method.
    }

    /**
     * Event called on logout.
     *
     * @return void
     */
    public function onLogout()
    {
        // TODO: Implement onLogout() method.
    }

    public function getFullName(): string
    {
        /**
* 
         *
 * @var User $ 
*/
        return "{$this->first_name} {$this->last_name}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
