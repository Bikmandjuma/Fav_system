<?php
class Post
{

    private $ds;

    public function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->ds = new DataSource();
    }

    public function getAllPost()
    {
        $query = "select * from tbl_products";
        $result = $this->ds->select($query);
        return $result;
    }

    public function getColumnName()
    {
        $query = "select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME=N'tbl_products'";
        $result = $this->ds->select($query);
        return $result;
    }
}
?>