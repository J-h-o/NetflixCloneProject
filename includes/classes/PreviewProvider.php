<?php 
class PreviewProvider{

    private $con;
    private $username;

    public function __construct($con, $username)
    {
        $this->con=$con;
        $this->username=$username;
    }

    public function createPreviewVideo($entity){
        if($entity==null){
            $entity = $this->getRandomEntity();
        }

        $name = $entity->getName();
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

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

                            <div class='buttons'>
                                <button><i class='fas fa-play button-spacer'></i>Play</button>
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