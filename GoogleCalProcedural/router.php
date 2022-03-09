<?php

class Router {
    private $presenter;

    function __construct(Presenter $presenter){
        $this->presenter = $presenter;
    }

	function doUserAction() {
		$this->presenter->putMenu();
		if (!isset($_GET['action']))
			return;
        $temp = strval($_GET['action']);
		$this->presenter->$temp();
	}
    
}

?>