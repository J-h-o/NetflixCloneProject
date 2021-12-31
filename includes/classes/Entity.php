<?php
class Entity{

    private $con;
    private $input;

    public function __construct($con, $input)
    {
        $this->con=$con;

        if(is_array($input)){
            $this->input=$input;
        }
        else{
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id",$input);
            $query->execute();
            
            $this->input=$query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getId(){
        return $this->input["id"];
    }

    public function getName(){
        return $this->input["name"];
    }

    public function getThumbnail(){
        return $this->input["thumbnail"];
    }

    public function getPreview(){
        return $this->input["preview"];
    }

    public function getCategoryId(){
        return $this->input["categoryId"];
    }

    public function getSeasons(){
        $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id AND isMovie=0 ORDER BY season, episode ASC");
        $query->bindValue(":id",$this->getId());
        $query->execute();

        $seasons = array();
        $videos = array();
        $currentSeason = null;

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {

            if($currentSeason!=null && $currentSeason!=$row["season"]){
                $seasons[] = new Season($currentSeason,$videos);
                $videos = array();
            }
            
            $currentSeason = $row["season"];
            $videos[] = new Video($this->con,$row);
            
        }
        
        if(sizeof($videos) != 0){
            $seasons[] = new Season($currentSeason,$videos);
        }

        return $seasons;
    }
}
?>