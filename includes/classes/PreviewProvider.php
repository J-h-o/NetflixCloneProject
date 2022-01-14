<?php
class PreviewProvider{

    private $con;
    private $username;

    public function __construct($con, $username)
    {
        $this->con=$con;
        $this->username=$username;
    }


    public function createCategoryPreview($categoryId){
        $entitiesArray = EntityProvider::getEntities($this->con,$categoryId,1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("Nothing to display :(");
        };

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createMovieShowPreview(){
        $entitiesArray = EntityProvider::getMovieEntities($this->con,null,1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No Movies to display");
        };

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createTvShowPreview(){
        $entitiesArray = EntityProvider::getTvEntities($this->con,null,1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No TV Shows to display");
        };

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function createPreviewVideo($entity){
        if($entity==null){
            $entity = $this->getRandomEntity();
        }

        $name = $entity->getName();
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();
        $videoId = VideoProvider::getEntityVideoForUser($this->con,$id, $this->username);
        $video = new Video($this->con, $videoId);
        $seasonEpisode = $video->getSeasonAndEpisode();
        $subtitle = $video->isMovie() ? "" : "<h4 style='color:white'>$seasonEpisode</h4>";
        $inProgress = $video->isInProgress($this->username);
        $playButtonText = $inProgress ? " Continue" : " Play";

        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden/>
                        <div class='previewVideoContainer'>
                            <video autoplay muted class='previewVideo' onended='previewEnd()'>
                                <source src='$preview' type='video/mp4'/>
                            </video>
                        </div>
                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            $subtitle
                            <div class='buttons'>
                                <button onClick='playNext($videoId)'><i class='fas fa-play button-spacer'></i>$playButtonText</button>
                                <button onClick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class='fade'></div>
                </div>";

    }

    public function createEntityPreviewSquare($entity){
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='browse.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'/>
                    </div>
                </a>
                ";
    }

    private function getRandomEntity()
    {
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}
?>