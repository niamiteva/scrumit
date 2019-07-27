<?php

require_once (CORE . 'BaseModel.php');

class ProjectModel extends BaseModel {
        public $project_id;//pk
        public $projectName;
        protected $conn;

        /*get data for ProjectView
                SELECT * FROM `projects` AS pr 
                INNER JOIN( 
                        SELECT * FROM `sprints` AS sp 
                        INNER JOIN `tasks` AS t ON sp.sprint_id = t.sprint 
                        ) AS `table` 
                ON pr.project_id = `table`.project 
                ORDER BY pr.projectName, `table`.sprintName
        */
}

?>