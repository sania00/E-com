<?php


class Product{

    const SHOW_BY_DEFAULT = 10;

    /**Return array product
     *
     *
     * @param int $count
     * @return array
     */
    public static function getLatestProduct ($count = self::SHOW_BY_DEFAULT){

        $count = intval($count);

        $db = Db::getConnection();

        $productList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                            .'WHERE status = "1" ORDER BY id DESC LIMIT '. $count);

        $i = 0;
        while($row = $result->fetch()){
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productList;

    }

    /**
     * Return array product by Category
     *
     * @param bool $categoryId
     * @return array
     */
    public static function getProductsListByCategory($categoryId = false){

        if($categoryId){

            $db = Db::getConnection();
            $products = array();
            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                . "WHERE status = '1' AND category_id = '$categoryId'"
                . "ORDER BY id DESC "
                . "LIMIT ".self::SHOW_BY_DEFAULT);

            $i = 0;
            while($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;

        }

    }

}