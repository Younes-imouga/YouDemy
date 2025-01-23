<?php

abstract class CourseContent {
    protected $contentType;

    public function __construct($contentType) {
        $this->contentType = $contentType;
    }

    abstract public function getContent();
}

class VideoContent extends CourseContent {
    private $videoUrl;

    public function __construct($videoUrl) {
        parent::__construct('video');
        $this->videoUrl = $videoUrl;
    }

    public function getContent() {
        return $this->videoUrl;
    }
}

class DocumentContent extends CourseContent {
    private $documentPath;

    public function __construct($documentPath) {
        parent::__construct('document');
        $this->documentPath = $documentPath;
    }

    public function getContent() {
        return $this->documentPath;
    }
}