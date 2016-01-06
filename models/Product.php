<?php


class Product{

    const SHOW_BY_DEFAULT = 6;

    /**Return array product
     *
     *
     * @param int $count
     * @return array
     */
    public static function getLatestProduct ($count = self::SHOW_BY_DEFAULT, $page = 1){

        $count = intval($count);
        $page = intval($page);
        $offset = $page * $count;
        $db = Db::getConnection();

        $productList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                            .'WHERE status = "1" '
                            .'ORDER BY id DESC '
                            .'LIMIT '. $count
                            .' OFFSET '.$offset);

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
     * Возвращает массив категории
     *
     * @param bool $categoryId
     *
     * @return array
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1){

        if($categoryId){

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $products = array();
            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                                ."WHERE status = '1' "
                                ."AND category_id = '$categoryId'"
                                ."ORDER BY id ASC "
                                ."LIMIT ".self::SHOW_BY_DEFAULT
                                .' OFFSET '.$offset);

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

    /**
     * Return array product by ID
     *
     * @param $id
     * @return mixed
     */
    public static function getProductById($id){

        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id ='. $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();

        }

    }

    /**
     * Returns total products
     *
     * @param $categoryId
     * @return mixed
     */
    public static function getTotolProductsInCategory($categoryId){

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product WHERE status="1" AND category_id="'.$categoryId.'"');

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

}