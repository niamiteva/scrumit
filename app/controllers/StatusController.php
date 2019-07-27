<?php 
require_once (MODEL . 'StatusModel.php');

class StatusController extends BaseController
{

  public function getAllStatuses(){
    $statuss = new StatusModel("status");
    $stmt = $statuss->getAll();
    $num = $stmt->rowCount();

    if($num>0){
        $statuses=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $status_item=array(
                'status_id' => $status_id,
                'status' => $status
            );
            array_push($statuses, $status_item);
        }
    
        http_response_code(200);
        return $statuses;
    }
    else{
        //TODO response class to display responses
        http_response_code(404); 
        return $jsonErr;
    }

}
}
?>