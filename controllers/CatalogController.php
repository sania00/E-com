<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class CatalogController{


    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProduct(12);

        require_once(ROOT. '/views/catalog/index.php');

        return true;
    }


    public function actionCategory($categoryId){

        $categories = array();
        $categories = Category::getCategoriesList();

        $CategoryProducts = array();
        $CategoryProducts = Product::getProductsListByCategory($categoryId);

        require_once(ROOT. '/views/catalog/category.php');

        return true;
    }

}