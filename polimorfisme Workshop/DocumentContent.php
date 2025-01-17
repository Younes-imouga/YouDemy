<?php

require_once("content.php");

class DocumentContent extends content {
    private $path;
    private $fileSize;

    public function __construct($db, $courseId, $path, $fileSize) {
        parent::__construct($db, $courseId);
        $this->path = $path;
        $this->fileSize = $fileSize;
    }

    public function save()
    {
        $sql = "INSERT INTO contents (course_id, type) VALUES (?, 'document')";
        $params = [
            $this->courseId
        ];

        $this->db->query($sql, $params);

        $contentId = $this->db->lastInsertId();

        $sql = "INSERT INTO document_contents (content_id, file_path, file_size) VALUES (?, ?, ?)";
        $params = [
            $contentId,
            $this->path,
            $this->fileSize
        ];

        $this->db->query($sql, $params);
    }

    public function display($contentId) {
        $sql = "SELECT title , DESCRIPTION , TYPE , file_path FROM courses
        INNER JOIN contents ON courses.id = contents.course_id
        INNER JOIN document_contents ON contents.id = document_contents.content_id
        WHERE courses.id = ?";

        $result = $this->db->fetch($sql, [$contentId]);

    }
}   