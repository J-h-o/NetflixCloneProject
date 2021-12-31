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

}
?>