<?php 

    class ProjectView {

        function __construct() {
        }

        function display($data){
            ////MODAL FORMS
            //constants
            $addTask = "addTask";
            $addProject  = "addProject";
            $addSprint = "addSprint";
            $addMember = "addMember";
            $editProject  ="editProject";
            $editSprint = "editSprint";
            $editTask = "editTask";
            $editMember = "editMember";
            $deleteProject ="deleteProject";
            $deleteSprint = "deleteSprint";
            $deleteTask = "deleteTask";
            $deleteMember = "deleteMember";
            //modal forms
            //add task
            $html = '
            <div id="addTask" class="modal">            
                <form class="modal-content animate " id="createTask" method="POST" action="">
                    <input type="hidden" name="act" value="createTask"/>
                    <input type="hidden" name="object" value="Task"/>
                    <div class="modal-header border-default">
                        <div class="modal-task-type">
                            <div class="modal-task-type-icon bg-default">
                                <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                            </div>';
                            //select type
                            $html .= '
                            <select name="type" class="select-type">';
                            foreach($data['types'] as $type){
                                $html .= '<option value="'.$type['type_id'].'">'.$type['type'].'</option>';
                            }
                            $html .= '
                            </select> ';
                        $html .= "
                        </div>
                        <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($addTask) ."))'>&times;</div>
                    </div>";
                    $html .= '
                    <div class="container border-default">
                        <label for="taskName"><b>Task Title</b></label>
                        <input type="text" placeholder="Enter task title" name="taskName" required>
                        
                        <label for="description"><b>Description</b></label>
                        <textarea placeholder="Enter description" name="description" required></textarea>
                        
                        <div class="short-field" style="margin-right: 14px">
                            <label for="priority"><b>Priority</b></label>
                            <input type="number" placeholder="Enter priority" name="priority" required>
                        </div>
                        <div class="short-field" style="margin-right: 14px">
                            <label for="value"><b>Value</b></label>
                            <input type="number" placeholder="Enter value" name="value" required>
                        </div>
                        <div class="short-field">
                            <label for="complete"><b>Complete %</b></label>
                            <input type="number" placeholder="Enter % complete" name="complete"> 
                        </div>
                        <div class="short-field" style="margin-right: 14px">
                            <label for="status"><b>Status</b></label>
                            <select name="status">';
                            //select satus
                            foreach($data['statuses'] as $status){
                                $html .= '<option value="'.$status['status_id'].'">'.$status['status'].'</option>';
                            }
                            //TODO team members
                            $html .= '
                            </select>
                        </div> 
                        <div class="short-field">
                            <label for="user"><b>Member</b></label>
                            <select name="user">
                                <option value="-">-</option>';
                            //select satus
                            if($data['members']!= null){
                            foreach($data['members'] as $member){
                                $html .= '<option value="'.$member['user_id'].'">'.$member['user'].'</option>';
                            }}
                            //TODO team members
                            $html .= '
                            </select>
                        </div> 
                        <div class="short-field">
                            <label for="sprint"><b>Sprint</b></label>
                            <select name="sprint">';
                            if($data['sprints'] != null){
                                foreach($data['sprints'] as $sprint){
                                    $html .= '<option value="'.$sprint['sprint_id'].'">'.$sprint['sprintName'].'</option>';
                                }
                            }
                            //TODO team members
                            $html .= '
                            </select>
                        </div> 
                        
                    </div>';
                    $html .= "
                    <div class='container border-default' style='background-color:#f1f1f1'>
                        <button type='button' class='cancel bg-bug' style='margin-left: 73%;' onclick='closeModal(document.getElementById(". json_encode($addTask) ."))'>Cancel</button>
                        <input type='submit' class='cancel bg-feature' style='margin-left: 5px;' value='Add Task'>
                    </div>
                </form>
            </div>";
            //edit tasks
        foreach($data['sprints_tasks'] as $sprints){
            if($sprints['tasks'] != null){
                foreach($sprints['tasks'] as $task){
                    $html .= '
                    <div id="'.$task['task_id'].'" class="modal">
                        <form class="modal-content animate" id="editTask" method="POST" action="">
                            <input type="hidden" name="act" id="act" value="editTask"/>
                            <input type="hidden" name="object" value="Task"/>
                            <input type="hidden" name="task_id" value="'.$task['task_id'].'">
                            <div class="modal-header border-default">
                                <div class="modal-task-type">
                                    <div class="modal-task-type-icon bg-default">
                                        <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                                    </div>';
                                    //select type
                                    $html .= '
                                    <select name="type" class="select-type">';
                                    foreach($data['types'] as $type){
                                        if($type['type_id'] == $task['type']){
                                            $html .= '<option value="'.$type['type_id'].'" selected="selected">'.$type['type'].'</option>';
                                        }else{
                                            $html .= '<option value="'.$type['type_id'].'">'.$type['type'].'</option>';
                                        }
                                    }
                                    $html .= '
                                    </select> ';
                                $html .= "
                                </div>
                                <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($task['task_id']) ."))'>&times;</div>
                            </div>";
                            $html .= '
                            <div class="container border-default">
                                <label for="taskName"><b>Task Title</b></label>
                                <input type="text" value="'.$task['taskName'].'" name="taskName" required>
                                
                                <label for="description"><b>Description</b></label>
                                <textarea name="description" >'.$task['description'].'</textarea>
                                
                                <div class="short-field" style="margin-right: 14px">
                                    <label for="priority"><b>Priority</b></label>
                                    <input type="number" value="'.$task['priority'].'" name="priority" required>
                                </div>
                                <div class="short-field" style="margin-right: 14px">
                                    <label for="value"><b>Value</b></label>
                                    <input type="number" value="'.$task['value'].'" name="value" required>
                                </div>
                                <div class="short-field">
                                    <label for="complete"><b>Complete %</b></label>
                                    <input type="number" value="'.$task['complete'].'" name="complete"> 
                                </div>
                                <div class="short-field" style="margin-right: 14px">
                                    <label for="status"><b>Status</b></label>
                                    <select name="status">';
                                    //select satus
                                    foreach($data['statuses'] as $status){
                                        if($status['status_id'] == $task['status']){
                                            $html .= '<option value="'.$status['status_id'].'" selected="selected">'.$status['status'].'</option>';
                                        }else{
                                        $html .= '<option value="'.$status['status_id'].'">'.$status['status'].'</option>';
                                        }
                                    }
                                    //TODO team members
                                    $html .= '
                                    </select>
                                </div> 
                                <div class="short-field">
                                    <label for="user"><b>Member</b></label>
                                    <select name="user">
                                        <option value="-">-</option>';
                                    //select satus
                                    if($data['members'] != null){
                                        foreach($data['members'] as $member){
                                            if($member['user_id'] == $task['user']){
                                            $html .= '<option value="'.$member['user_id'].'" selected="selected">'.$member['user'].'</option>';
                                            }
                                            else{
                                                $html .= '<option value="'.$member['user_id'].'">'.$member['user'].'</option>';
                                            }
                                        }
                                    }
                                    //TODO team members
                                    $html .= '
                                    </select>
                                </div> 
                                <div class="short-field">
                                    <label for="sprint"><b>Sprint</b></label>
                                    <select name="sprint">';
                                    //select satus
                                    foreach($data['sprints'] as $sprint){
                                        if($sprint['sprint_id'] == $task['sprint']){
                                        $html .= '<option value="'.$sprint['sprint_id'].'" selected="selected">'.$sprint['sprintName'].'</option>';
                                        }
                                        else{
                                            $html .= '<option value="'.$sprint['sprint_id'].'">'.$sprint['sprintName'].'</option>';
                                        }
                                    }
                                    //TODO team members
                                    $html .= '
                                    </select>
                                </div> 
                            </div>';
                            $act = "act";
                            $delete = "deleteTask";
                            $html .= "
                            <div class='container border-default' style='background-color:#f1f1f1'>
                                <button type='button' class='cancel bg-bug' style='margin-left: 63%;' onclick='closeModal(document.getElementById(". json_encode($editTask) ."))'>Cancel</button>
                                <input type='submit' name='update' class='cancel bg-feature' style='margin-left: 5px;' value='Save'>
                                <button type='button' name='remove' onclick='submitThis(".json_encode($act).",".json_encode($delete)."); this.form.submit();'class='cancel bg-bug'  style='margin-left: 5px;'>Delete</button>
                            </div>
                        </form>
                    </div>";
                }
            }
        }
            //add sprint
            $html .= '
            <div id="addSprint" class="modal">
                <form class="modal-content animate" id="createSprint" method="POST" action="">
                    <input type="hidden" name="act" value="createSprint"/>
                    <input type="hidden" name="object" value="Sprint"/>
                    <div class="modal-header border-default">
                        <div class="modal-task-type">
                            <div class="modal-task-type-icon bg-default">
                                <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                            </div>
                            Add New Sprint
                        </div>';
                        $html .= "
                        <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($addSprint) ."))'>&times;</div>
                    </div>";
                    $html .= '
                    <div class="container border-default">
                        <label for="sprintName"><b>Sprint Name</b></label>
                        <input type="text" placeholder="Enter Sprint name" name="sprintName" required>
                        <label for="sprintName"><b>For Project: </b></label>
                        <select name="project">';
                        //select satus
                        foreach($data['projects'] as $project){
                            $html .= '<option value="'.$project['project_id'].'">'.$project['projectName'].'</option>';
                        }
                        //TODO team members
                        $html .= '
                        </select> 
                    </div>

                    <div class="container border-default" style="background-color:#f1f1f1">';
                    $html .= "
                        <button type='button' class='cancel bg-bug' style='margin-left: 73%;' onclick='closeModal(document.getElementById(". json_encode($addSprint) ."))'>Cancel</button>";
                        $html .= '
                        <input type="submit" class="cancel bg-feature" style="margin-left: 5px;" name="addsprint" value="Add Sprint">
                    </div>
                </form>
            </div>';
             //edit sprint
        if($data['sprints'] != null){
        foreach($data['sprints'] as $sprint){
             $html .= '
             <div id="'.$sprint['sprint_id'].'" class="modal">
                 <form class="modal-content animate" id="editSprint" method="POST" action="">
                     <input type="hidden" name="act" value="editSprint"/>
                     <input type="hidden" name="object" value="Sprint"/>
                     <input type="hidden" name="sprint_id" value="'.$sprint['sprint_id'].'">
                     <div class="modal-header border-default">
                         <div class="modal-task-type">
                             <div class="modal-task-type-icon bg-default">
                                 <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                             </div>
                             Edit Sprint
                         </div>';
                         $html .= "
                         <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($sprint['sprint_id']) ."))'>&times;</div>
                     </div>";
                     $html .= '
                     <div class="container border-default">
                         <label for="sprintName"><b>Sprint Name</b></label>
                         <input type="text" value="'.$sprint['sprintName'].'" name="sprintName" required>
                         <label for="sprintName"><b>For Project: </b></label>
                         <select name="project">';
                         //select satus
                         foreach($data['projects'] as $project){
                             if($project['project_id'] == $sprint['project']){
                                $html .= '<option value="'.$project['project_id'].'" selected="selected">'.$project['projectName'].'</option>';
                             }else{
                             $html .= '<option value="'.$project['project_id'].'">'.$project['projectName'].'</option>';
                             }
                         }
                         //TODO team members
                         $html .= '
                         </select> 
                     </div>
                     <div class="container border-default" style="background-color:#f1f1f1">';
                     $html .= "
                         <button type='button' class='cancel bg-bug' style='margin-left: 73%;' onclick='closeModal(document.getElementById(". json_encode($sprint['sprint_id']) ."))'>Cancel</button>";
                         $html .= '
                         <input type="submit" class="cancel bg-feature" style="margin-left: 5px;" name="editsprint" value="Save Sprint">
                     </div>
                 </form>
             </div>';
        }
        }
            //edit project
            $html .= '
            <div id="editProject" class="modal">
                <form class="modal-content animate" id="editProject" method="POST" action="">
                    <input type="hidden" name="act" value="editProject"/>
                    <input type="hidden" name="object" value="Project"/>
                    <input type="hidden" name="project_id" value="'.$data['project']['project_id'].'">
                    <div class="modal-header border-default">
                        <div class="modal-task-type">
                            <div class="modal-task-type-icon bg-default">
                                <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                            </div>
                            Edit Project
                        </div>';
                        $html .= "
                        <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($editProject) ."))'>&times;</div>
                    </div>";
                    $html .= "
                    <div class='container border-default'>
                        <label for='projectName'><b>Project Name</b></label>
                        <input type='text' value='".$data['project']['projectName']."' name='projectName' required>
                    </div>

                    <div class='container border-default' style='background-color:#f1f1f1'>";
                    $html .= "
                        <button type='button' class='cancel bg-bug' style='margin-left: 73%;' onclick='closeModal(document.getElementById(". json_encode($editProject) ."))'>Cancel</button>
                        <input type='submit' class='cancel bg-feature' style='margin-left: 5px;' value='Save Project'>
                    </div>
                </form>
            </div>";
            //add member
            $position = array("Developer", "PM", "Owner", "Designer", "QA", "Software Architect");
            $html .= '
            <div id="addMember" class="modal">            
                <form class="modal-content animate " id="createMember" method="POST" action="">
                    <input type="hidden" name="act" value="createMember"/>
                    <input type="hidden" name="object" value="Member"/>
                    <div class="modal-header border-default">
                        <div class="modal-task-type">
                            <div class="modal-task-type-icon bg-default">
                                <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                            </div>';
                        $html .= "
                        </div>
                        <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($addMember) ."))'>&times;</div>
                    </div>";
                    $html .= '
                    <div class="container border-default">
                        <label for="user"><b>Member Name</b></label>
                        <input type="text" placeholder="Enter member name" name="user" required>
                        <div class="short-field" style="margin-right: 14px">
                            <label for="email"><b>Email</b></label>
                            <input type="email" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="short-field" style="margin-right: 14px">
                            <label for="position"><b>Position</b></label>
                            <select name="position">';
                                foreach($position as $pos){
                                    $html .= '<option value="'.$pos.'">'.$pos.'</option>';
                                }
                            $html .= '
                            </select> 
                        </div> 
                        <div class="short-field" style="margin-right: 14px">
                            <label for="project"><b>Project</b></label>
                            <select name="project">';
                                //select satus
                                foreach($data['projects'] as $project){
                                    $html .= '<option value="'.$project['project_id'].'">'.$project['projectName'].'</option>';
                                }
                                //TODO team members
                            $html .= '
                            </select> 
                        </div> 
                    </div>';
                    $html .= "
                    <div class='container border-default' style='background-color:#f1f1f1'>
                        <button type='button' class='cancel bg-bug' style='margin-left: 72%;' onclick='closeModal(document.getElementById(". json_encode($addMember) ."))'>Cancel</button>
                        <input type='submit' class='cancel bg-feature' style='margin-left: 5px;' value='Add Member'>
                    </div>
                </form>
            </div>";
            //edit member
            if($data['members'] != null){
            foreach($data['members'] as $member){
             $html .= '
             <div id="'.$member['user_id'].'" class="modal">
             <form class="modal-content animate" id="editMember" method="POST" action="">
                 <input type="hidden" name="act" id="actM" value="editMember"/>
                 <input type="hidden" name="object" value="Member"/>
                 <input type="hidden" name="user_id" value="'.$member['user_id'].'">
                    <div class="modal-header border-default">
                        <div class="modal-task-type">
                            <div class="modal-task-type-icon bg-default">
                                <div class="card-icon" style="width: 2rem; height: 2rem;"></div>
                            </div>';
                        $html .= "
                        </div>
                        <div class='close' title='Close Modal' onclick='closeModal(document.getElementById(". json_encode($editMember) ."))'>&times;</div>
                    </div>";
                    $html .= '
                    <div class="container border-default">
                        <label for="user"><b>Member Name</b></label>
                        <input type="text" value="'.$member['user'].'" name="user" required>
                        <div class="short-field" style="margin-right: 14px">
                            <label for="email"><b>Email</b></label>
                            <input type="email" name="email" value="'.$member['email'].'" required>
                        </div>
                        <div class="short-field" style="margin-right: 14px">
                            <label for="position"><b>Position</b></label>
                            <select name="position">';
                                //select satus
                                foreach($position as $pos){
                                    if($pos == $member['position']){
                                    $html .= '<option value="'.$pos.'" selected="selected">'.$pos.'</option>';
                                    }else{
                                    $html .= '<option value="'.$pos.'">'.$pos.'</option>';
                                    }
                                }
                                //TODO team members
                                $html .= '
                            </select> 
                        </div> 
                        <div class="short-field" style="margin-right: 14px">
                            <label for="status"><b>Project</b></label>
                            <select name="project">';
                                //select satus
                                foreach($data['projects'] as $project){
                                    if($project['project_id'] == $member['project']){
                                    $html .= '<option value="'.$project['project_id'].'" selected="selected">'.$project['projectName'].'</option>';
                                    }else{
                                    $html .= '<option value="'.$project['project_id'].'">'.$project['projectName'].'</option>';
                                    }
                                }
                                //TODO team members
                                $html .= '
                            </select> 
                        </div> 
                    </div>';
                    $act = "actM";
                    $delete = "deleteMember";
                    $html .= "
                    <div class='container border-default' style='background-color:#f1f1f1'>
                            <button type='button' class='cancel bg-bug' style='margin-left: 63%;' onclick='closeModal(document.getElementById(". json_encode($editMember) ."))'>Cancel</button>
                            <input type='submit' name='updateM' class='cancel bg-feature' style='margin-left: 5px;' value='Save'>
                            <button type='button' name='remove' onclick='submitThis(".json_encode($act).",".json_encode($delete)."); this.form.submit();'class='cancel bg-bug'  style='margin-left: 5px;'>Delete</button>
                    </div>
                </form>
            </div>";
            }}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONTENTS////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tabs menu////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //constants
            $backlog = "backlog";
            $bl = 'bl';
            $sprints = "sprints";
            $spr  = "spr";
            $team = "team";
            $t = "t";
           
            //$configure = "configure";
            //$conf = "conf";
            $html .= "
            <main>
                <div class='boardmenu'>
                    <div class='board-btn' onclick='openTab(event, ". json_encode($backlog) .",". json_encode($bl) .")' id='bl'>
                        <img class='board-btn-icon' src='src/img/backlog.png'>
                        <span class='tooltiptext'>Product Backlog</span>
                    </div>";
//sprint tab button - drop down if more than one project sprints////////////////////////////////////////////////////////////              
                $html .= "
                    <div class='board-btn' id='spr'>
                        <img class='board-btn-icon' src='src/img/sprint.png'>
                        <div class='tooltiptext'>
                            <span>Active Sprints</span>
                            <div class='dropdown-content'>";
                            if($data['sprints'] != null){
                                foreach($data['sprints'] as $sprint){
                                    if($sprint['sprintName'] != "Backlog"){
                                        $sprinttab = "sprint-" . $sprint['sprint_id'];
                                        $html .= "
                                        <div class='config' onclick='openTab(event, ".json_encode($sprinttab) .",". json_encode($spr) .")' id='spr'>
                                            ".$sprint['sprintName']."
                                        </div>";
                                    }
                                }
                            }
                            $html .= "
                            </div>
                        </div>
                    </div>";
                $html .= "
                    <div class='board-btn' onclick='openTab(event,". json_encode($team) .",". json_encode($t) .")' id='t'>
                        <img class='board-btn-icon' src='src/img/team.png'>
                        <span class='tooltiptext'>Team Members</span>
                    </div>
                    <div class='board-btn' id='conf'>
                        <img class='board-btn-icon' src='src/img/settings.png'>
                        <div class='tooltiptext'>
                            <span>Configure Project</span>
                            <div class='dropdown-content'>
                                <div class='config' onclick='openModal(document.getElementById(". json_encode($addProject) ."))'>Add Project</div>
                                <div class='config' onclick='openModal(document.getElementById(". json_encode($addSprint) ."))'>Add Sprint</div>
                                <div class='config' onclick='openModal(document.getElementById(". json_encode($addTask) ."))'>Add Task</div>
                                <div class='config' onclick='openModal(document.getElementById(". json_encode($addMember) ."))'>Add Team Member</div>
                                <div class='config' onclick='openModal(document.getElementById(". json_encode($editProject) ."))'>Edit Project</div>
                                <form id='deleteProject' method='POST' action='/scrumit/'>
                                    <input type='hidden' name='act' value='deleteProject'/>
                                    <input type='hidden' name='object' value='Project'/>
                                    <input type='hidden' name='project_id' value='".$data['project']['project_id']."'>
                                    <button class='delete'>Delete Project</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";

//backlog tab panel content//////////////////////////////////////////////////////////////////////////////////////
                $html .= '
                <div id="backlog" class="content">
                <ul class="breadcrumb">
                    <li><a href="/scrumit/">Home</a></li>
                    <li><a href="?page=Project&id='.$data['project']['project_id'].'">'.$data['project']['projectName'].'</a></li>
                </ul>';
                foreach($data['sprints_tasks'] as $sprint) {
                    $html .= '
                    <div class="board-col">
                        <div class="board-list">
                            <div class="board-list-head bg-bug">'.$sprint['sprint']['sprintName'];
                            $html .= "
                                <div class='sprint-config'><img class='board-btn-icon' src='src/img/more.png'>
                                    <div class='sprint-config-dropdown'>
                                        <div class='config' onclick='openModal(document.getElementById(". json_encode($addSprint) ."))'>Add Sprint</div>";
                                        if($sprint['sprint']['sprintName'] != "Backlog"){
                                            $html .= "<div class='config' onclick='openModal(document.getElementById(". json_encode($sprint['sprint']['sprint_id']) ."))'>Edit Sprint</div>
                                            <form id='deleteSprint' method='POST' action='?page=Project&id=".$data['project']['project_id']."'>
                                                <input type='hidden' name='act' value='deleteSprint'/>
                                                <input type='hidden' name='object' value='Sprint'/>
                                                <input type='hidden' name='sprint_id' value='".$sprint['sprint']['sprint_id']."'>
                                                <button class='delete black'>Delete Sprint</button>
                                            </form>";
                                        }
                                        $html .= "<div class='config' onclick='openModal(document.getElementById(". json_encode($addTask) ."))'>Add Task</div>
                                        
                                    </div>
                                </div>
                            </div>";
                            $html .= '
                            <div class="task-list" ondrop="drop(event)" ondragover="allowDrop(event)" id="'.$sprint['sprint']['sprint_id'].'">
                                <div class="scroll">';
                            if($sprint['tasks'] != null){
                                foreach($sprint['tasks'] as $task){
                                    $typeValue = '';
                                    foreach($data['types'] as $type){
                                        if($task['type'] == $type['type_id']){
                                            $typeValue = $type['type'];
                                        }
                                    }
                                    $html .= "
                                    <div class='task-card border-".$typeValue."' draggable='true' ondragstart='drag(event)' id='task-".$task['task_id']."' onclick='openModal(document.getElementById(". json_encode($task['task_id']) ."))'>
                                        <div class='task-card-header'>
                                            <div class='task-card-icon-corner bg-".$typeValue."'>
                                                <div class='card-icon'>
                                                    <img class='board-btn-icon' src='src/img/".$typeValue.".png'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='task-card-info'>
                                        
                                            <p class='task-card-title'>
                                                ".$task['taskName']."
                                            </p>
                                            <div class='task-card-member'>";
                                            if($data['members'] != null){
                                                foreach($data['members'] as $member){
                                                    if($task['user'] == $member['user_id']){
                                                        $html .= $member['user'];
                                                    }
                                                }
                                            }
                                            $html .= "</div>
                                        </div>
                                    </div>";
                                }
                            }
                                $html .= '
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                $html .= '
                </div>';

//sprint board tab panel///////////////////////////////////////////////////////////////////////////////////////////////////
            foreach($data['sprints_tasks'] as $sprint){
                $html .= "
                <div id='sprint-".$sprint['sprint']['sprint_id']."' class='content'>
                <ul class='breadcrumb'>
                    <li><a href='/scrumit/'>Home</a></li>
                    <li><a href='?page=Project&id='".$data['project']['project_id']."'>".$data['project']['projectName']."</a></li>
                    <li>".$sprint['sprint']['sprintName']."</li>
                </ul>";
                foreach($data['statuses'] as $status){
                    $html .= '
                    <div class="board-col">
                        <div class="board-list">
                            <div class="board-list-head bg-bug">'.$status['status'];
                                $html .= "
                                <div class='addtask-btn' onclick='openModal(document.getElementById(". json_encode($addTask) ."))'>
                                    <img class='board-btn-icon' src='src/img/add.png'>
                                </div>
                            </div>";
                            $html .= '
                            <div class="task-list" ondrop="drop(event)" ondragover="allowDrop(event)" id="'.$status['status'].'">
                                <div class="scroll">';
                        if($sprint['tasks'] != null){
                            foreach($sprint['tasks'] as $task){
                                if($task['status'] == $status['status_id']){
                                    $typeValue = '';
                                    foreach($data['types'] as $type){
                                        if($task['type'] == $type['type_id']){
                                            $typeValue = $type['type'];
                                        }
                                    }
                                    $html .= "
                                    <div class='task-card border-".$typeValue."' draggable='true' ondragstart='drag(event)' id='task-".$task['task_id']."' onclick='openModal(document.getElementById(". json_encode($task['task_id']) ."))'>
                                        <div class='task-card-header'>
                                            <div class='task-card-icon-corner bg-".$typeValue."'>
                                                <div class='card-icon'>
                                                    <img class='board-btn-icon' src='src/img/".$typeValue.".png'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='task-card-info'>
                                            <p class='task-card-title'>
                                                ".$task['taskName']."
                                            </p>
                                            <div class='task-card-member'>";
                                            if($data['members'] != null){
                                                foreach($data['members'] as $member){
                                                    if($task['user'] == $member['user_id']){
                                                        $html .= $member['user'];
                                                    }
                                                }
                                            }
                                            $html .= "</div>
                                        </div>
                                    </div>";
                                }
                            }
                        }
                                $html .= '
                                </div>
                            </div>
                        </div>
                    </div>';
                }                       
                $html .= '
                </div>';
            }

//project team members tab panel////////////////////////////////////////////////////////////////////////////////////////////
                $html .= '
                <div id="team" class="content">
                <ul class="breadcrumb">
                    <li><a href="/scrumit/">Home</a></li>
                    <li><a href="?page=Project&id='.$data['project']['project_id'].'">'.$data['project']['projectName'].'</a></li>
                    <li>Team</li>
                </ul>
                    <div class="main-content">';
                    if($data['members'] != null){
                    foreach ($data['members'] as $member) {
                        $html .= "
                        <div class='info-card' onclick='openModal(document.getElementById(". json_encode($member['user_id']) ."))' id='card-".$member['user_id']."'>
                            <div class='info-card-header'>
                                <div class='info-card-header-icon'></div>
                                <div class='info-card-header-title'><strong>".$member['user']."</strong></div>
                            </div>
                            <div class='info-card-content'>
                                <div class='member-avatar'>
                                    <img class='member' src='src/img/member.png'>
                                </div>
                                <div class='content-title'>Position</div>";
                                
                                $html .= "<div class='content-item'><strong>".$member['position']."</strong></div>";
                                
                            $html .= "
                            </div>
                        </div>";
                    } }       
                $html .= '
                    </div>
                </div>
            </main>';

            return $html;

        }

    }
?>