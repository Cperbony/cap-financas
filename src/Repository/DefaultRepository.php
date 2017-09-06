<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 28/08/2017
 * Time: 22:44
 */
declare(strict_types=1);

namespace CAPFin\Repository;

use Illuminate\Database\Eloquent\Model;

class DefaultRepository implements RepositoryInterface
{
    private $_modelClass;
    /**
     * @var Model from Eloquent
     */
    private $_model;

    /**
     * DefaultRepository constructor.
     * O Construtor recebe o nome do modelo
     * Gera uma instância deste Modelo
     *
     * @param    string $modelClass
     * @internal param string $model
     */
    public function __construct(string $modelClass)
    {
        $this->_modelClass = $modelClass;
        $this->_model = new $modelClass;
    }

    public function all(): array
    {
        return $this->_model->all()->toArray();
    }

    public function create(array $data)
    {
        $this->_model->fill($data);
        $this->_model->save();
        return $this->_model;
    }

    /**
     * @param int   $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $model = $this->findInternal($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findInternal($id);
        $model->delete();
    }

    /**
     * @param int  $id
     * @param bool $failIfNotExist
     * @return mixed
     */
    public function find(int $id, bool $failIfNotExist = true)
    {
        return $failIfNotExist ? $this->_model->findOrFail($id) : $this->_model->find($id);
    }

    public function findByField(string $field, $value)
    {
        return $this->_model->where($field, '=', $value)->get();
    }

    public function findOneBy(array $search)
    {
        $queryBuilder = $this->_model;
        foreach ($search as $field => $value) {
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }
        return $queryBuilder->firstOrFail();
    }

    protected function findInternal($id)
    {
        return (is_array($id)) ? $model = $this->findOneBy($id) : $this->find($id);
    }
}
