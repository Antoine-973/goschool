<?php


namespace App\Controller\Admin;


use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use App\Query\CustomQuery;
use App\Query\ParamQuery;

class AdminThemeController extends Controller
{
    private $request;

    private $customQuery;

    private $paramQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->customQuery = new CustomQuery();
        $this->paramQuery = new ParamQuery();
    }

    public function index()
    {
        $session = new Session();
        $id = $session->getSession('user_id');

        $testPermission = new \Core\Util\RolePermission();

        if ($id && $testPermission->has_permission($id, 'change_theme')) {
            $this->render("admin/theme/theme.phtml");
        } else {
            $request = new \Core\Http\Request();
            $request->redirect('/admin/dashboard/index', ['flashMessage','Vous n\'avez pas les droits nécessaires pour accéder à cette section du back office.']);
        }
    }

    public function darkTheme()
    {
        $idCustom = '1';
        $data['nav_bg_color'] = '212121';
        $data['foot_bg_color'] = '212121';
        $data['foot_color'] = '6c757d';
        $data['side_bg_color'] = '212121';
        $data['back_color'] = '303030';
        $data['menu_color'] = 'ced4da';
        $data['h1_color'] = 'ced4da';
        $data['h2_color'] = 'ced4da';
        $data['h3_color'] = 'ced4da';
        $data['h4_color'] = 'ced4da';
        $data['p_color'] = 'ced4da';
        $customQuery = new CustomQuery();
        if($customQuery->update($data,$idCustom)){
            $theme=['theme'=>'Dark'];
            $paramQuery = new ParamQuery();
            if($paramQuery->updateTheme($theme,$idCustom)){
                $this->request->redirect('/admin/theme/index', ['flashMessage','Le theme sombre a bien été appliqué.']);
            } else {
                $this->request->redirect('/admin/theme/index', ['flashMessage','Une erreur s\'est produite. Veuillez réessayer.']);
            }
        } else {
            $this->request->redirect('/admin/theme/index', ['flashMessage','Une erreur est survenue, veuillez rééssayer.']);
        }
    }

    public function goschoolTheme()
    {
        $idCustom = '1';
        $data['nav_bg_color'] = '363740';
        $data['foot_bg_color'] = '363740';
        $data['foot_color'] = '6c757d';
        $data['side_bg_color'] = '363740';
        $data['back_color'] = 'f3f3f3';
        $data['menu_color'] = 'ced4da';
        $data['h1_color'] = '363740';
        $data['h2_color'] = '363740';
        $data['h3_color'] = '363740';
        $data['h4_color'] = '363740';
        $data['p_color'] = '363740';
        $customQuery = new CustomQuery();
        if($customQuery->update($data,$idCustom)){
            $theme=['theme'=>'GoSchool'];
            $paramQuery = new ParamQuery();
            if($paramQuery->updateTheme($theme,$idCustom)){
                $this->request->redirect('/admin/theme/index', ['flashMessage','Le theme de base a bien été appliqué.']);
            } else {
                $this->request->redirect('/admin/theme/index', ['flashMessage','Une erreur s\'est produite. Veuillez réessayer.']);
            }
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function primaryTheme()
    {
        $idCustom = '1';
        $data['nav_bg_color'] = '2a9d8f';
        $data['foot_bg_color'] = '2a9d8f';
        $data['foot_color'] = '6c757d';
        $data['side_bg_color'] = '2a9d8f';
        $data['back_color'] = 'fdfcdc';
        $data['menu_color'] = 'e9c46a';
        $data['side_color'] = 'f4a261';
        $data['h1_color'] = 'e76f51';
        $data['h2_color'] = 'e76f51';
        $data['h3_color'] = 'e76f51';
        $data['h4_color'] = 'e76f51';
        $data['p_color'] = 'f4a261';
        $customQuery = new CustomQuery();
        if($customQuery->update($data,$idCustom)){
            $theme=['theme'=>'Primary'];
            $paramQuery = new ParamQuery();
            if($paramQuery->updateTheme($theme,$idCustom)){
                $this->request->redirect('/admin/theme/index', ['flashMessage','Le theme primaire a bien été appliqué.']);
            } else {
                $this->request->redirect('/admin/theme/index', ['flashMessage','Une erreur s\'est produite. Veuillez réessayer.']);
            }
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function universityTheme()
    {
        $idCustom = '1';
        $data['nav_bg_color'] = '334257';
        $data['foot_bg_color'] = '334257';
        $data['foot_color'] = '6c757d';
        $data['side_bg_color'] = '334257';
        $data['back_color'] = 'EEEEEE';
        $data['menu_color'] = '548CA8';
        $data['h1_color'] = '476072';
        $data['h2_color'] = '476072';
        $data['h3_color'] = '476072';
        $data['h4_color'] = '476072';
        $data['p_color'] = '476072';
        $customQuery = new CustomQuery();
        if($customQuery->update($data,$idCustom)){
            $theme=['theme'=>'University'];
            $paramQuery = new ParamQuery();
            if($paramQuery->updateTheme($theme,$idCustom)){
                $this->request->redirect('/admin/theme/index', ['flashMessage','Le theme pour ecole supérieur a bien été appliqué.']);
            } else {
                $this->request->redirect('/admin/theme/index', ['flashMessage','Une erreur s\'est produite. Veuillez réessayer.']);
            }
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }
}