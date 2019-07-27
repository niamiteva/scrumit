<?php
require_once (MODEL . 'TaskModel.php');
require_once (CONTROLLER . 'ProjectController.php');

///////////////////////////////////////////////////////////////////////////////////////////
//WHAT'S INSIDE THE CLASS
///////////////////////////////////////////////////////////////////////////////////////////
//create project method, which gets the form inputs and sends the to the Model's DB requests
//updates project
//renders all project's info + boards + team
///////////////////////////////////////////////////////////////////////////////////////////

class TaskController extends BaseController
{
    public function getAllTasks(){
        $task = new TaskModel("tasks");
        $stmt = $task->getll();
        $num = $stmt->rowCount();

        if($num>0){
            $tasks=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $task_item=array(
                    'sprint' => $sprint,
                    'task_id' => $task_id,
                    'taskName' => $taskName,
                    'user' => $user,
                    'description' => $description,
                    'type' => $type,
                    'value' => $value,
                    'status' => $status,
                    'complete' => $complete,
                    'priority' => $priority
                );
                array_push($tasks, $task_item);
            }
        
            http_response_code(200);
            return $tasks;
        }
        else{
            //TODO response class to display responses
            http_response_code(404); 
            return $jsonErr;
        }
    }
    
    public function createTask() {
        $task = new TaskModel("tasks");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $taskName = $_POST['taskName'];
            $sprint = $_POST['sprint'];
            $description = $_POST['description'];
            $user = $_POST['user'];
            $type = $_POST['type'];
            $value = $_POST['value'];
            $status = $_POST['status'];
            $complete = $_POST['complete'];
            $priority = $_POST['priority'];
        }

        $data = array('task_id' => '', 
                      'sprint' => $sprint, 
                      'taskName' => $taskName, 
                      'description' => $description,
                      'user' => $user,
                      'type' => $type,
                      'value' => $value,
                      'status' => $status,
                      'complete' => $complete,
                      'priority'  => $priority);
        
        if(!empty($data)){
            if($task->insert($data)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == "Task") $this->index();
    }

    public function editTask() {
        $task = new TaskModel("tasks");
            
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $taskName = $_POST['taskName'];
            $task_id = $_POST['task_id'];
            $sprint = $_POST['sprint'];
            $description = $_POST['description'];
            $user = $_POST['user'];
            $type = $_POST['type'];
            $value = $_POST['value'];
            $status = $_POST['status'];
            $complete = $_POST['complete'];
            $priority = $_POST['priority'];
        

            $data = array('task_id' => $task_id, 
                        'sprint' => $sprint, 
                        'taskName' => $taskName, 
                        'description' => $description,
                        'user' => $user,
                        'type' => $type,
                        'value' => $value,
                        'status' => $status,
                        'complete' => $complete,
                        'priority'  => $priority);
            
            if(!empty($data)){
                if($task->update('task_id', $data, $task_id)){
                    http_response_code(200);
                }
                else{
                    http_response_code(400);
                }
            }
        }

        // $projectCtrl = new ProjectController();
        // $projectCtrl->index();
    }

    public function deleteTask(){
        
        $task = new TaskModel("tasks");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $task_id = $_POST['task_id'];
        
            $data = array(
                'task_id' => $task_id);
            
            if(!empty($data)){
                if($task->deleteById('task_id', $task_id)){
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