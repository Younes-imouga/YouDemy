<?php 

abstract class content {
    protected $id;
    protected $courseId;
    protected $createdAt;
    protected $db;

    public function __construct($db, $courseId) {
        $this->db = $db;
        $this->courseId = $courseId;
        $this->createdAt = new datetime(); 
    }

    abstract public function save();
    abstract public function display($contentId);
}