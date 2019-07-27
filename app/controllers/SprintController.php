<?php
require_once (MODEL . 'SprintModel.php');
require_once (MODEL . 'TaskModel.php');

require_once (CONTROLLER . 'ProjectController.php');

///////////////////////////////////////////////////////////////////////////////////////////
//WHAT'S INSIDE THE CLASS
///////////////////////////////////////////////////////////////////////////////////////////
//create project method, which gets the form inputs and sends the to the Model's DB requests
//updates project
//renders all project's info + boards + team
///////////////////////////////////////////////////////////////////////////////////////////

class SprintController extends BaseController
{
    public function getAllSprints(){
        $sprint = new SprintModel("sprints");
        $stmt = $sprint->getAll();
        $num = $stmt->rowCount();

        if($num>0){
            $sprints=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $sprint_item=array(
                    'sprint_id' => $sprint_id,
                    'project' => $project,
                    'sprintName' => $sprintName
                );
                array_push($sprints, $sprint_item);
            }
        
            http_response_code(200);
            return $sprints;
        }
        else{
            //TODO response class to display responses
            http_response_code(404); 
            return $jsonErr;
        }
    }

    public function getSprintsTasks($id){
      $tasks = new TaskModel("tasks");
      $stmt = $tasks->getAllByFK('sprint', $id);
      $num = $stmt->rowCount();
  
      if($num>0){
          $tasks=array();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              extract($row);
              $task_item=array(
                  'task_id' => $task_id,
                  'sprint' => $sprint,
                  'taskName' => $taskName,
                    'user' => $user,
                    'description' => $description,
                    'type' => $type,
                    'value' => $value,
                    'status' => $status,
                    'complete' => $complete,
                    'priority' => $priority,
                  
              );
              array_push($tasks, $task_item);
          }
      
          http_response_code(200);
          return $tasks;
      }
      else{
          //TODO response class to display responses
         // http_response_code(404);
      }
    }

    public function createSprint() {
        $sprint = new SprintModel("sprints");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sprintName = $_POST['sprintName'];
            $project = $_POST['project'];
        }

        $data = array('sprint_id' => '', 'project' => $project, 'sprintName' => $sprintName);
        
        if(!empty($data)){
            if($sprint->insert($data)){
                http_response_code(200);
                //echo json_encode(array("message" => "User was created."));
            }
            else{
                http_response_code(400);
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == "Sprint") $this->index();
    }

    public function editSprint() {
        $sprint = new SprintModel("sprints");
            
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project = $_POST['project'];
            $sprint_id  = $_POST['sprint_id'];
            $sprintName = $_POST['sprintName'];
        }

        $data = array(
            'project' => $project,
            'sprint_id'  => $sprint_id,
            'sprintName' => $sprintName);
        
        if(!empty($data)){
            if($sprint->update('sprint_id', $data, $sprint_id)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }
        
    }

    public function deleteSprint(){
        $sprint = new SprintModel("sprints");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sprint_id = $_POST['sprint_id'];
        
            $data = array(
                'sprint_id' => $sprint_id);
            
            if(!empty($data)){
                if($sprint->deleteById('sprint_id', $sprint_id)){
                    http_response_code(200);
                }
                else{
                    http_response_code(400);
                }
            }
        }

    }

    //TODO
    //delete sprint

    // public function index (){
    // }
}
?>