<?php 
class EntityProvider{

    public static function getEntities($con, $categoryId, $limit){
        $sql_string = "SELECT * FROM entities ";

        if($categoryId != null){
            $sql_string.="WHERE categoryId=:categoryId ";
        }

        $sql_string .= "ORDER BY RAND() LIMIT :limit";

        $query = $con->prepare($sql_string);

        if($categoryId !=null){
            $query->bindValue(":categoryId", $categoryId);
        }

        $query->bindValue(":limit",$limit,PDO::PARAM_INT);
        $query->execute();

        $result = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row);
        }
        
        return $result;
    }

    public static function getTvEntities($con, $categoryId, $limit){
        $sql_string = "SELECT DISTINCT (entities.id) FROM `entities`
                        INNER JOIN videos ON entities.id = videos.entityId
                        WHERE videos.isMovie = 0 ";

        if($categoryId != null){
            $sql_string.="AND categoryId=:categoryId ";
        }

        $sql_string .= "ORDER BY RAND() LIMIT :limit ";

        $query = $con->prepare($sql_string);
        $query->bindValue(":limit",$limit,PDO::PARAM_INT);

        if($categoryId !=null){
            $query->bindValue(":categoryId", $categoryId);
        }

        $query->execute();

        $result = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row["id"]);
        }
        
        return $result;
    }

    public static function getMovieEntities($con, $categoryId, $limit){
        $sql_string = "SELECT DISTINCT (entities.id) FROM `entities`
                        INNER JOIN videos ON entities.id = videos.entityId
                        WHERE videos.isMovie = 1 ";

        if($categoryId != null){
            $sql_string.="AND categoryId=:categoryId ";
        }

        $sql_string .= "ORDER BY RAND() LIMIT :limit ";

        $query = $con->prepare($sql_string);
        $query->bindValue(":limit",$limit,PDO::PARAM_INT);

        if($categoryId !=null){
            $query->bindValue(":categoryId", $categoryId);
        }

        $query->execute();

        $result = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row["id"]);
        }
        
        return $result;
    }

    public static function getSearchEntities($con, $term){
        $sql_string = "SELECT * FROM entities WHERE name LIKE CONCAT('%',:term, '%') LIMIT 20";

        $query = $con->prepare($sql_string);
        $query->bindValue(":term",$term);
        $query->execute();
        
        $result = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Entity($con, $row);
        }
        
        return $result;
    }

}
?>