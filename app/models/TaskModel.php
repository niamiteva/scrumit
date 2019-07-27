<?php

require_once (CORE . 'BaseModel.php');

class TaskModel extends BaseModel {
        public $task_id;//pk
        public $sprint;//fk
        public $taskName;
        public $user;//fk
        public $description;
        public $type;//fk
        public $value;
        public $status;//fk
        public $complete;
        public $priority;
}

?>