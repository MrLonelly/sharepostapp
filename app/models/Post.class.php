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
        $this->_db->query('SELECT *,
                            posts.id as postId,
                            users.id as userId
                            FROM posts
                            INNER JOIN users ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC
                            ');

        $results = $this->_db->resultSet();

        return $results;
    }
}

?>