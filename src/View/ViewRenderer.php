<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 22/08/2017
 * Time: 23:12
 */
declare(strict_types = 1);
namespace CAPFin\View;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class ViewRenderer implements ViewRendererInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twigEnvironment;
    /**
     * ViewRenderer constructor.
     *
     * @param \Twig_Environment $twigEnvironment
     */
    public function __construct(\Twig_Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * @param string $template
     * @param array  $context
     * @return ResponseInterface
     * chamar o twigEnvironment, passando o template e o contexto
     * guardar este resultado e gerar um Response Interface ZendDiactoros
     * Escrever no coprpo da resposta o resultadp.
     * @return $response
     */
    public function render(string $template, array $context = []): ResponseInterface
    {
        $result = $this->twigEnvironment->render($template, $context);
        $response = new Response();
        $response->getBody()->write($result);
        return $response;
    }
}
