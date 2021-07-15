<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class CategoryQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @return array $data
     */
    public function getCategories()
    {
        $query = $this->builder->select('id, name, slug, description')->from("categories");
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById($id)
    {
        $query = $this->builder->select("name, slug, categorie_parent, description")->from("categories")->where("id = $id");
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getCategoriesName()
    {
        $query = $this->builder->select('name')->from("categories");
        return $query->getResult();
    }

    /**
     * @return array $data
     */
    public function getCategoriesIdByName(string $name)
    {
        $query = $this->builder->select('id')->from("categories")->where("name = $name");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {

        $data['name'] = str_replace(' ', '-', $data['name']);

        if(array_key_exists('categorie_parent', $data)){

            if ($data['categorie_parent'] == 'Aucune'){
                $data['categorie_parent'] = null;
            }
        }

        $data['slug'] = strtolower(str_replace(' ', '-', $data['name']));

        $query = $this->builder->insertInto('categories')->columns($data)->values($data)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function updateCategory(array $data, int $id)
    {
        if(array_key_exists('categorie_parent', $data)){

            if ($data['categorie_parent'] == 'Aucune'){
                $data['categorie_parent'] = null;
            }
        }

        $data['slug'] = strtolower(str_replace(' ', '-', $data['slug']));

        $query = $this->builder->update("categories")->set($data)->where("id = $id")->save();
        return $query;
    }

    /**
     * @param int $id
     */
    public function deleteCategory($id)
    {
        $query = $this->builder->delete()->from('categories')->where("id = $id")->save();
        return $query;
    }

    public function orderByDate()
    {
        $query = $this->builder->select('name, slug, created_at')->from("categories")->orderBy('created_at','DESC');
        return $query->getResult();
    }
}