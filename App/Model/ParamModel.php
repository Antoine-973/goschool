<?php

namespace App\Model;
use Core\Database\Model;

class ParamModel extends Model
{
    private $site_name;

    private $url;

    private $visible;

    private $default_role;

    private $name_role;

    private $description;

    private $lang;

    private $save;

    private $update;

    public function setSiteName($site_name)
    {
        $this->site_name = $site_name;
    }
    
    public function getSiteName()
    {
        return $this->site_name;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    public function getUrl()
    {
        return $this->url;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    
    public function getVisible()
    {
        return $this->visible;
    }

    public function setDefaultRole($default_role)
    {
        $this->default_role = $default_role;
    }
    
    public function getDefaultRole()
    {
        return $this->default_role;
    }

    public function setNameRole($name_role)
    {
        $this->name_role = $name_role;
    }
    
    public function getNameRole()
    {
        return $this->name_role;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function setLang($lang)
    {
        $this->lang = $lang;
    }
    
    public function getLang()
    {
        return $this->lang;
    }

    public function setSave($save)
    {
        $this->save = $save;
    }
    
    public function getSave()
    {
        return $this->save;
    }

    public function setUpdate($update)
    {
        $this->update = $update;
    }
    
    public function getUpdate()
    {
        return $this->update;
    }

    public function rules()
    {
        return [
            'site_name' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'url' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'visible' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'default_role' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'name_role' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'description' => ['type' => 'string', 'required' => 'required', 'max' => 400],
            'lang' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'save' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
            'update' => ['type' => 'string',  'min' => 4, 'required' => 'required', 'max' => 55],
        ];

    }
}
