<?php
namespace App\Query;

use Core\Database\QueryBuilder;
use Core\Util\Hash;

class ParamQuery{

    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @return array $data
     */
    public function getParam()
    {
        $query = $this->builder->select('site_name, url, visible, default_role, default_article_category, mail_host, mail_port, mail_login, mail_password, default_home_page, post_show_count, description, lang')->from("parameters");
        return $query->getResult();
    }

    public function getSiteName()
    {
        $query = $this->builder->select('site_name')->from("parameters");
        return $query->getResult();
    }

    /**
     * @param array $data
     */
    public function updateParam(array $data, int $id)
    {
        $roleQuery = new RoleQuery();
        $categoryQuery = new CategoryQuery();
        $pageQuery = new PageQuery();
        $hash = new Hash();

        $data['default_role'] = $roleQuery->getIdbyName($data['default_role'])['id'];
        $data['default_article_category'] = $categoryQuery->getCategoriesIdByName($data['default_article_category'])['id'];
        $data['default_home_page'] = $pageQuery->getPageIdByTitle($data['default_home_page'])['id'];
        $data['mail_password'] = $hash->passwordHash($data['mail_password']);

        $query = $this->builder->update("parameters")->set($data)->where("id = $id")->save();
        return $query;
    }

    /**
     * @return array $data
     */
    public function getSocials()
    {
        $query = $this->builder->select('twitter,facebook,linkedin,instagram')->from("parameters");
        return $query->getResult();
    }

}