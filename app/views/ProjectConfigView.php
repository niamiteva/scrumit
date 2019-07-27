<?php 

    class ProjectConfigView {

        function __construct() {
        }

        function display($data){
            
            $html = '<main class="all">'. $data['projectName'] ; 
                $html .='<button id="deletePr">Delete project</button>

                        <button id="editbtnpr">Edit project</button>
                        <div id="editProject" class="modal">
                            <form class="modal-content animate" id="editProject" method="POST" action="">
                                <input type="hidden" name="act" value="editProject"/>
                                <input type="hidden" name="project_id" value="'.$data['project_id'].'">
                                <div class="imgcontainer">
                                    <span class="closeedit" title="Close Modal">&times;</span>
                                </div>

                                <div class="container">
                                    <label for="projectName"><b>Project Name</b></label>
                                    <input type="text" placeholder="Enter Project name" name="projectName" value="'.$data['projectName'].'"required>
                                    <input type="submit" value="Edit Project" >
                                </div>

                                <div class="container" style="background-color:#f1f1f1">
                                    <button type="button" id="closeeditbtn" class="cancelbtnpr">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </main>';

            return $html;

        }

    }
?>