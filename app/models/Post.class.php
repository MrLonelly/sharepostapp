<?php

class Post
{
    private $_db;
    
    public function __construct()
    {
        $this->_db = new Database();
    }

    public function getPosts()
    {
        $this->_db->query('SELECT * FROM posts');

        $results = $this->_db->resultSet();

        return $results;
    }
}

?>