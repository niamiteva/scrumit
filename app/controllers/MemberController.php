<?php
require_once (MODEL . 'MemberModel.php');
require_once (CONTROLLER . 'ProjectController.php');

///////////////////////////////////////////////////////////////////////////////////////////
//WHAT'S INSIDE THE CLASS
///////////////////////////////////////////////////////////////////////////////////////////
//create project method, which gets the form inputs and sends the to the Model's DB requests
//updates project
//renders all project's info + boards + team
///////////////////////////////////////////////////////////////////////////////////////////

class MemberController extends BaseController
{
    public function getAllMembers(){
        $user = new MemberModel("users");
        $stmt = $user->getll();
        $num = $stmt->rowCount();

        if($num>0){
            $users=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $user_item=array(
                  'user' => $user,
                  'user_id' => $user_id,
                  'email' => $email,
                  'project' => $project,
                  'position' => $position
              );
              array_push($users, $user_item);
            }
        
            http_response_code(200);
            return $users;
        }
        else{
            //TODO response class to display responses
            http_response_code(404); 
            return $jsonErr;
        }
    }
    
    public function createMember() {
        $users = new MemberModel("users");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['user'];
            $project = $_POST['project'];
            $position = $_POST['position'];
            $email = $_POST['email'];
        }

        $data = array('user_id' => '', 
                      'user' => $user, 
                      'email' => $email, 
                      'position' => $position,
                      'project' => $project);
        
        if(!empty($data)){
            if($users->insert($data)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == "Member") $this->index();
    }

    public function editMember() {
      $users = new MemberModel("users");
      echo json_encode($_SERVER['REQUEST_METHOD']);
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $user_id = $_POST['user_id'];
          $user = $_POST['user'];
          $project = $_POST['project'];
          $position = $_POST['position'];
          $email = $_POST['email'];
      

        $data = array('user_id' => $user_id, 
                      'user' => $user, 
                      'email' => $email, 
                      'position' => $position,
                      'project' => $project);
        
        if(!empty($data)){
            if($users->update('user_id', $data, $user_id)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }
      }
    }

    public function deleteMember(){
        $user = new MemberModel("users");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'];
        
            $data = array(
                'user_id' => $user_id);
            
            if(!empty($data)){
                if($user->deleteById('user_id', $user_id)){
                    http_response_code(200);
                }
                else{
                    http_response_code(400);
                }
            }
        }

    }
}
?>