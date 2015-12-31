<?php
	require_once 'frontend/views/view.php';
	class index{
		public function inicio(){
			renderResponse(view_prueba::index('hola.html',"Prueba"));
		}
	}
?>