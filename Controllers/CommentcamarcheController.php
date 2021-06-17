<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategorieModel;

class CommentCaMarcheController extends Controller
{
    public function index()
    {
		var_dump('ca arche');
        $utilisateurs = new UserModel;
        $utilisateurs = $utilisateurs->findAll();
        $categories_list = new CategorieModel;
        $categories_list = $categories_list->findCategories();
        $this->render('comment_ca_marche/index', ['utilisateurs'=>$utilisateurs,'categories_list'=>$categories_list]);
        
    }
}