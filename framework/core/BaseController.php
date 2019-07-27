<?php
require_once (MODEL . 'ProjectModel.php');
require_once (VIEW . 'ProjectView.php');
//require_once (CORE . 'BaseModel.php');

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//WHAT'S INSIDE THE CLASS
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//builds page
//gets all projects, couse thay are in the side nav in every page
//gets the projects boards, same reason
//gets project by id, to link the project page
//gets board by id, same reason
///////////////////////////////////////////////////////////////////////////////////////////////////////////

class BaseController {

     // Base Controller has a property called $loader, it is an instance of Loader class(introduced later)
     protected $loader;

     //fix this ?/????
     public function __construct(){
     }

    //BUILDS THE PAGE INTERFACE; RENDERER
    function display($view,$navdata =array(), $data = array()) {
		$header = HeaderView::display();	
        $footer = FooterView::display();
        $sidenav = SideNavView::display($navdata);	
		$current_view = $view::display($data);

		$result = BaseView::display(array('header'=>$header,'footer'=>$footer,'sidenav'=>$sidenav,'body'=>$current_view));	
		
		echo $result;
    }

    //returns the names of the projects for the side nav
    public function getALLProjects(){
        $project = new ProjectModel("projects");
        $stmt = $project->getAll();
        $num = $stmt->rowCount();
    
        if($num>0){
            $projects=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $project_item=array(
                    'project_id' => $project_id,
                    'projectName' => $projectName
                );
                array_push($projects, $project_item);
            }
        
            http_response_code(200);
            return $projects;
        }
        else{
            //TODO response class to display responses
            http_response_code(404); 
            return $jsonErr;
        }
    }

    //TODO: fixes
    //use as a link
    public function getProjectById(){
        $project = new ProjectModel("projects");
        $projectId = $_GET['id'];

        $stmt = $project->getById('project_id', $projectId);

        $num = $stmt->rowCount();
        if($num == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $project_item=array(
                'project_id' => $project_id,
                'projectName' => $projectName
            );
            http_response_code(200);
            return $project_item;
        }
        else{
            http_response_code(400);
        }
    }

    }


