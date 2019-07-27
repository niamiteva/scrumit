<?php 

    ///////////////////////////////////////////////////////////////////////////////////
    //default view, when the app is loaded
    //displays all projects, with their boards and team
    //////////////////////////////////////////////////////////////////////////////////

    class MainView {

        function __construct() {
        }

        function display($data){
            
            $html ='
            <main>
                <div class="main-content">';

            foreach ($data['allData'] as $project) {
                $html .= "
                <div class='info-card'>
                    <a href='?page=Project&id=".$project['project']['project_id']."'>
                        <div class='info-card-header'>
                            <div class='info-card-header-icon'>img</div>
                            <div class='info-card-header-title'><strong>".$project['project']['projectName']."</strong></div>
                        </div>
                        <div class='info-card-content'>
                            <div class='content-title'>Active Sprints</div>";
                        if($project['sprints'] != null){
                            foreach ($project['sprints'] as $sprint) {
                                $html .= "<div class='content-item'><strong>".$sprint['sprintName']."</strong></div>";
                            }
                        }
                        $html .= "
                            <div class='content-title'>Team Members</div>";
                            if($project['members'] != null){
                                foreach($project['members'] as $member){
                                    $html .= "<div class='content-item'><strong>".$member['user']."</strong></div>";
                                }
                            }
                        $html .= "
                        </div>
                    </a>
                </div>";
            }

            $html .= '
                </div>
            </main>';

            return $html;
        }

    }

?>