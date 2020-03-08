<?php
    class Project {
        private $id;
        private $title; 
        private $description; 
        private $teaser; 
        private $githubLink; 
        private $youtubeLink;

        function __construct($id, $title, $description, $teaser, $githubLink, $youtubeLink) {
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->teaser = $teaser;
            $this->githubLink = $githubLink;
            $this->youtubeLink = $youtubeLink;
        }

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getTitle(){
            return $this->title;
        }
    
        public function setTitle($title){
            $this->title = $title;
        }
    
        public function getDescription(){
            return $this->description;
        }
    
        public function setDescription($description){
            $this->description = $description;
        }
    
        public function getTeaser(){
            return $this->teaser;
        }
    
        public function setTeaser($teaser){
            $this->teaser = $teaser;
        }
    
        public function getGithubLink(){
            return $this->githubLink;
        }
    
        public function setGithubLink($githubLink){
            $this->githubLink = $githubLink;
        }
    
        public function getYoutubeLink(){
            return $this->youtubeLink;
        }
    
        public function setYoutubeLink($youtubeLink){
            $this->youtubeLink = $youtubeLink;
        }
    }

    class Skill {
        private $id;
        private $name;
        private $imagePath;
        
        function __construct($id, $name, $imagePath) {
            $this->id = $id;
            $this->name = $name;
            $this->imagePath = $imagePath;
        }

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getName(){
            return $this->name;
        }
    
        public function setName($name){
            $this->name = $name;
        }
    
        public function getImagePath(){
            return $this->imagePath;
        }
    
        public function setImagePath($imagePath){
            $this->imagePath = $imagePath;
        }
    }