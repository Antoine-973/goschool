<?php


namespace App\Controller\Admin;


use Core\Controller;
use Core\Http\Request;
use Core\Http\Session;
use App\Query\CustomQuery;

class AdminThemeController extends Controller
{
    private $request;

    private $customQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->customQuery = new CustomQuery();
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
            $this->request->redirect('/admin/theme/index')->with('success', 'La customisation a bien été ajoutée.');
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
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
            $this->request->redirect('/admin/theme/index')->with('success', 'La customisation a bien été ajoutée.');
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
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
        $data['h1_color'] = 'e76f51';
        $data['h2_color'] = 'e76f51';
        $data['h3_color'] = 'e76f51';
        $data['h4_color'] = 'e76f51';
        $data['p_color'] = 'f4a261';
        $customQuery = new CustomQuery();
        if($customQuery->update($data,$idCustom)){
            $this->request->redirect('/admin/theme/index')->with('success', 'La customisation a bien été ajoutée.');
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
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
            $this->request->redirect('/admin/theme/index')->with('success', 'La customisation a bien été ajoutée.');
        } else {
            $this->request->redirect('/admin/theme/index')->with('error', 'Une erreur c\'est produite. Veuillez réessayer.');
        }
    }
}