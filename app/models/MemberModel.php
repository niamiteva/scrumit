<?php

require_once (CORE . 'BaseModel.php');

class MemberModel extends BaseModel {
        public $user_id;//pk
        public $position;//fk
        public $user;
        public $project;
        public $email;
}

?>