<?php

class Post
{
    private $_db;
    
    public function __construct()
    {
        $this->_db = new Database();
    }

    // Get posts from db
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

    // Get posts from db by id
    public function getPostById($id)
    {
        $this->_db->query('SELECT * FROM posts WHERE id = :id');

        $this->_db->bind(':id', $id);
        $results = $this->_db->single();

        return $results;
    }

    // Delete post by id
    public function deletePostById($id)
    {
        $this->_db->query('DELETE FROM posts WHERE id = :id');

        $this->_db->bind(':id', $id);
        
        if($this->_db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Add a new post
    public function addPost($data)
    {
        

        // Init query
        $this->_db->query('INSERT INTO posts (title, user_id, body, created_at) VALUES (:title, :user_id, :body, now())');

        // Bind values
        $this->_db->bind(':title', $data['post_title']);
        $this->_db->bind(':user_id', $data['user_id']);
        $this->_db->bind(':body', $data['post_body']);

        // Execute
        if($this->_db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Update post
    public function updatePost($data)
    {
        

        // Init query
        $this->_db->query('UPDATE posts SET title = :title, body = :body, user_id = :user_id, created_at = now() WHERE id = :id');

        // Bind values
        $this->_db->bind(':title', $data['post_title']);
        $this->_db->bind(':user_id', $data['user_id']);
        $this->_db->bind(':id', $data['id']);
        $this->_db->bind(':body', $data['post_body']);

        // Execute
        if($this->_db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>