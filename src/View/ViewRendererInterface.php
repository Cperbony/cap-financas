<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/08/2017
 * Time: 23:07
 */
declare(strict_types = 1);
namespace CAPFin\View;

use Psr\Http\Message\ResponseInterface;

interface ViewRendererInterface
{
    //Renderizar o template
    public function render(string $template, array $context = []): ResponseInterface;
}
