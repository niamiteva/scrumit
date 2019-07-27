<?php

class BaseView {
    function __construct() {
    }

	public function display($data){
		return "
			".$data['header']."
			".$data['sidenav']."
			".$data['body']."
			".$data['footer'];
	}
}

?>