<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 22:25
 */


use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        /**
        * @return mixed
        */
        '/category-costs', function () use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('category-cost.repository');
            $auth = $app->service('auth');
            /**
        * 
             *
        * @var \CAPFin\Repository\DefaultRepository $repository 
        */
            $categories = $repository->findByField('user_id', $auth->user()->getId());
            return $view->render(
                'category-costs/list.html.twig', [
                'categories' => $categories
                ]
            );
        }, 'category-costs.list'
    )
    ->get(
        '/category-costs/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render(
                'category-costs/create.html.twig'
            );
        }, 'category-costs.new'
    )
    ->post(
        /**
        * @param ServerRequestInterface $request
        * @return \Psr\Http\Message\ResponseInterface
        */
        '/category-costs/store', function (ServerRequestInterface $request) use ($app) {
            //Cadastro de Category - Armazenar os dados na variável $data
            $data = $request->getParsedBody();
            $repository = $app->service('category-cost.repository');
            $auth = $app->service('auth');
            $data['user_id'] = $auth->user()->getId();
            $repository->create($data);
            //retornar uma resposta, direcionando para a category-costs
            return $app->route(
                'category-costs.list'
            );
        }, 'category-costs.store'
    )
    ->get(
        '/category-costs/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('category-cost.repository');
            $id = $request->getAttribute('id');
            $auth = $app->service('auth');
            $category = $repository->fineOneBy(
                [
                'id' => $id,
                'user_id' => $auth->user()->getId()
                ]
            );
            return $view->render(
                'category-costs/edit.html.twig', [
                'category' => $category
                ]
            );
        }, 'category-costs.edit'
    )
    ->post(
        '/category-costs/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('category-cost.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();
            $auth = $app->service('auth');
            $data['user_id'] = $auth->user()->getId();
            $repository->update(
                [
                'id' => $id,
                'user_id' => $auth->user()->getId()
                ], $data
            );
            return $app->route(
                'category-costs.list'
            );
        }, 'category-costs.update'
    )
    ->get(
        '/category-costs/{id}/show', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('category-cost.repository');
            $id = $request->getAttribute('id');
            $auth = $app->service('auth');
            $category = $repository->findOneBy(
                [
                'id' => $id,
                'user_id' => $auth->user()->getId()
                ]
            );
            return $view->render(
                'category-costs/show.html.twig', [
                'category' => $category
                ]
            );
        }, 'category-costs.show'
    )
    ->get(
        '/category-costs/{id}/delete', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('category-cost.repository');
            $id = $request->getAttribute('id');
            $auth = $app->service('auth');
            $repository->delete(
                [
                'id' => $id,
                'user_id' => $auth->user()->getId()
                ]
            );
            return $app->route(
                'category-costs.list'
            );
        }, 'category-costs.delete'
    );
