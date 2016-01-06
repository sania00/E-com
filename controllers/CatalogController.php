<?php

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
    public function actionCategory($categoryId, $page = 1){

        $categories = array();
        $categories = Category::getCategoriesList();

        $CategoryProducts = array();
        $CategoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotolProductsInCategory($categoryId);

        //Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT. '/views/catalog/category.php');

        return true;
    }

}