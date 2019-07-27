<?php 

    class SideNavView {

        function __construct() {
        }

        function display($navdata){
            $addProject = "addProject";
            $html = "<div class='sidenav bg-dark'>
                        <button id='openbtnpr' onclick='openModal(document.getElementById(". json_encode($addProject) ."))'>+Add Project</button>";

            foreach ($navdata['projects'] as $project) {
              $html .= '<div class="accordion">
                            <a class="project-btn" href="?page=Project&id='.$project['project_id'].'">';
                                $html .= $project['projectName'];
                  $html .= '</a>';
              $html .= '</div>';
            }

            $html .= '</div>
                      <div id="addProject" class="modal">
                        <form class="modal-content animate" id="createProject" method="POST" action="">
                            <input type="hidden" name="act" value="createProject"/>
                            <input type="hidden" name="object" value="Project"/>
                            <div class="modal-header border-default">
                              <div class="modal-task-type">
                                  <div class="modal-task-type-icon bg-default">
                                      <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                                  </div>
                                  Add New Project
                              </div>';
                              $html .= "
                              <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($addProject) ."))'>&times;</div>
                            </div>";
                            $html .= '
                            <div class="container border-default">
                              <label for="projectName"><b>Project Name</b></label>
                              <input type="text" placeholder="Enter Project name" name="projectName" required>
                            </div>

                            <div class="container border-default" style="background-color:#f1f1f1">';
                            $html .= "
                                <button type='button' class='cancel bg-bug' style='margin-left: 73%;' onclick='closeModal(document.getElementById(". json_encode($addProject) ."))'>Cancel</button>
                                <input type='submit' class='cancel bg-feature' style='margin-left: 5px;' value='Add Project'>
                            </div>
                        </form>
                      </div>";
            return $html;
        }

    }

?>