<?php

class Chat extends Controller{
	public function presentacion(){
		echo $this->view->render('chat/presentacion');
	}
}