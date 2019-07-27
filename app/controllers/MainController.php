<?php 

//////////////////////////////////////////////////////////////////
//dispalys projects list
//displays projects' boards list
//displays boards' team members
//////////////////////////////////////////////////////////////////

require_once (CORE . 'BaseController.php');
require_once (CONTROLLER . 'ProjectController.php');

class MainController extends BaseController {

    //colects the data to be dispalyed
    public function index (){
      $allData = array();
      $projects = $this->getALLProjects();
      $projectCtrl = new ProjectController();
      foreach($projects as $project){
          $sprints = $projectCtrl->getProjectsSprints($project['project_id']);
          $members = $projectCtrl->getProjectsMembers($project['project_id']);
          //team members
          array_push($allData, array('project' => $project,
                                      'sprints' => $sprints,
                                      'members' => $members));
      }
      
      //$projectBoards = $this->getProjectBoards();
      //$boards = 

      $this->display(
        'MainView', 
          array(
            'projects'=>$projects,
          ),
          array(
            'allData' => $allData,
            //'members' => $members
          )
      );
  }
}



?>