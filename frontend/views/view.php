<?php
	class view_prueba{
		public static function index($html,$title,$arr = null){
			$valores = [
				'Title' => $title,
				'container' => dinamic("frontend/views/indexViews/".$html, $arr)
			];
			$templad = loadPage("frontend/assets/templad/default.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>