<?php 
class Video {
    
    private $con;
    private $input;
    private $entity;

    public function __construct($con, $input)
    {
        $this->con=$con;

        if(is_array($input)){
            $this->input=$input;
        }
        else{
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindValue(":id",$input);
            $query->execute();
            
            $this->input=$query->fetch(PDO::FETCH_ASSOC);
        }

        $this->entity = new Entity($con, $this->input["entityId"]);
    }

    public function getId(){
        return $this->input["id"];
    }

    public function getTitle(){
        return $this->input["title"];
    }

    public function getDescription(){
        return $this->input["description"];
    }

    public function getFilePath(){
        return $this->input["filePath"];
    }

    public function getThumbnail(){
        return $this->entity->getThumbnail();
    }

    public function getEpisodeNumber(){
        return $this->input["episode"];
    }
}
?>