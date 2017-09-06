<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 30/08/2017
 * Time: 12:54
 */

namespace CAPFin\View\Twig;


use CAPFin\Auth\AuthInterface;

class TwigGlobals extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var AuthInterface
     */
    private $auth;

    /**
     * TwigGlobals constructor.
     */
    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function getGlobals()
    {
        return [
            'Auth' => $this->auth
        ];
    }
}
