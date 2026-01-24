<?php
    namespace App\Http\Controllers;

    use App\Models\Categorie;

    class CategoryController{
        private Categorie $categorie;

        public function __construct(){
            $this->categorie = new Categorie();
        }

        public function navbar(){
            $categories  = $this->categorie->getCategories();
            view("partials/navbar", ['categories' => $categories]);
        }
    }