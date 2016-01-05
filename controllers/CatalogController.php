<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

/**
 * Class CatalogController
 *
 * Категории товаров
 */

class CatalogController{

    /**
     * Каталог на главной странице
     *
     * @return bool
     */
    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProduct(6);

        require_once(ROOT. '/views/catalog/index.php');

        return true;
    }


    /**
     * Каталог по категориям
     *
     * Принимает ID категории
     *
     * @param $categoryId
     *
     * Принимает номер страницы
     *
     * @param int $page
     *
     * @return bool
     */
    public function actionCategory($categoryId, $page =1){

        echo 'Категория: '.$categoryId;
        echo '<br>Страница: '.$page;

        $categories = array();
        $categories = Category::getCategoriesList();

        $CategoryProducts = array();
        $CategoryProducts = Product::getProductsListByCategory($categoryId, 7);

        require_once(ROOT. '/views/catalog/category.php');

        return true;
    }

}