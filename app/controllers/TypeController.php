<?php 
require_once (MODEL . 'TypeModel.php');

class TypeController extends BaseController
{
  
  public function getAllTypes(){
    $typem = new TypeModel("type");
    $stmt = $typem->getAll();
    $num = $stmt->rowCount();

    if($num>0){
        $types=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $type_item=array(
                'type_id' => $type_id,
                'type' => $type
            );
            array_push($types, $type_item);
        }
    
        http_response_code(200);
        return $types;
    }
    else{
        //TODO response class to display responses
        http_response_code(404); 
        return $jsonErr;
    }

}
}

?>