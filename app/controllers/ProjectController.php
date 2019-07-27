<?php
require_once (MODEL . 'ProjectModel.php');
require_once (MODEL . 'SprintModel.php');
require_once (MODEL . 'MemberModel.php');
require_once (CONTROLLER . 'SprintController.php');
require_once (CONTROLLER . 'TypeController.php');
require_once (CONTROLLER . 'StatusController.php');

///////////////////////////////////////////////////////////////////////////////////////////
//WHAT'S INSIDE THE CLASS
///////////////////////////////////////////////////////////////////////////////////////////
//create project method, which gets the form inputs and sends the to the Model's DB requests and creates empty backlog sprint
//gets project id by given column
//updates project
//renders all project's info + boards + team
///////////////////////////////////////////////////////////////////////////////////////////

class ProjectController extends BaseController
{

    public function createProject() {
        $project = new ProjectModel("projects");
        $sprint = new SprintModel("sprints");
        //if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['input_name']))
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $projectName = $_POST['projectName'];
        }

        $data = array('project_id' => '', 'projectName' => $projectName);
        if(!empty($data)){
            if($project->insert($data)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }

        $fk = $this->getProjectByColumn('projectName', $projectName);
        $sprintData = array('sprint_id' => '', 'project' => $fk['project_id'] , 'sprintName' => 'Backlog');
        if(!empty($sprintData)){
            if($sprint->insert($sprintData)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }

        //$_SERVER['REQUEST_URI'] -> get current page uri

        if(isset($_GET['page']) && $_GET['page'] == "Project") $this->index();
    }

    public function getProjectByColumn($column, $value){
        $project = new ProjectModel("projects");
        $stmt = $project->getByColumn('project_id', $column, $value);

        $num = $stmt->rowCount();
        if($num == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $project_item=array(
                'project_id' => $project_id,
            );
            http_response_code(200);
            return $project_item;
        }
        else{
            http_response_code(400);
        }

    }

    public function getProjectsSprints($id){
        $sprint = new SprintModel("sprints");
        $stmt = $sprint->getAllByFK('project', $id);
        $num = $stmt->rowCount();
    
        if($num>0){
            $sprints=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $sprint_item=array(
                    'project' => $project,
                    'sprint_id' => $sprint_id,
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
        }
    }

    public function getProjectsMembers($id){
        $user = new MemberModel("users");
        $stmt = $user->getAllByFK('project', $id);
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
        }
    }


    public function editProject() {
        $project = new ProjectModel("projects");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project_id = $_POST['project_id'];
            $projectName = $_POST['projectName'];
        }

        $data = array(
            'project_id' => $project_id,
            'projectName' => $projectName);
        
        if(!empty($data)){
            if($project->update('project_id', $data, $project_id)){
                http_response_code(200);
            }
            else{
                http_response_code(400);
            }
        }
        $this->index();
    }

    public function deleteProject(){
        $project = new ProjectModel("projects");
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project_id = $_POST['project_id'];
        
            $data = array(
                'project_id' => $project_id);
            
            if(!empty($data)){
                if($project->deleteById('project_id', $project_id)){
                    http_response_code(200);
                }
                else{
                    http_response_code(400);
                }
            }
        }

    }

    //TODO:
    //delete project

    public function index(){
        $projectById = $this->getProjectById();//to get project's boards
        $projects = $this->getALLProjects();

        $sprints = $this->getProjectsSprints($projectById['project_id']);
        $members = $this->getProjectsMembers($projectById['project_id']);
        $sprint_ctrl = new SprintController();
        //$tasks = array();
        $sprints_tasks = array();
        $project_tasks = array();
        if($sprints != null){
            foreach( $sprints as $sprint){
                //TODO:
                //modify this => make sprints asosiative array with el (sprint, sprint_tasks)
                $tasks=$sprint_ctrl->getSprintsTasks($sprint['sprint_id']);
                array_push($sprints_tasks, array ('sprint' => $sprint,
                                                    'tasks' => $tasks));
                array_push($project_tasks, $tasks);
            }
        }

        $type_ctrl = new TypeController();
        $types = $type_ctrl->getAllTypes();
        $status_ctrl = new StatusController();
        $statuses = $status_ctrl->getAllStatuses();

        //project team

        $this->display('ProjectView', 
                        array ('projects' => $projects),
                        array ('projects' =>$projects,
                                'project' => $projectById, 
                                'sprints' => $sprints, 
                                'sprints_tasks' => $sprints_tasks,
                                'tasks' => $project_tasks,
                                'types' => $types,
                                'statuses' => $statuses,
                                'members' => $members
                        )     
        );
    }
}
?>