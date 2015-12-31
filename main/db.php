<?php
	class datebase{
		private $conexion;
		var $tableName;
		var $rules;
		var $attributeLabels;
		var $getIdDefecto;
		function __construct($tableName, $rules, $attributeLabels, $getIdDefecto){
			$this->tableName = $tableName;
			$this->rules = $rules;
			$this->attributeLabels = $attributeLabels;
			$this->getIdDefecto = $getIdDefecto;
			if (!isset($this->conexion)) {
				$this->conexion=mysql_connect(host,user,pw)or die("Probelmas con la conexion ".mysql_errno());
				mysql_select_db(db,$this->conexion) or die("Probelmas con la base de datos ".mysql_error());
			}
		}
		public function queryAll($arr,$at){
			foreach ($arr as $key => $value) {
				if(!is_array($value)){
					$consul = $key." = '".$value."' ";
				}else{
					$consul .= $value['con']." ".$key." ".$value['acc']." '".$value['value']."' ";
				}
			}
			$valor = implode(",", $this->rules);
			$query = $this->query("SELECT $valor FROM $this->tableName WHERE $consul $at");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function queryRow($arr){
			if(is_array($arr)){
				foreach ($arr as $key => $value) {
					if(!is_array($value)){
						$consul = $key." = '".$value."' ";
					}else{
						$consul .= $value['con']." ".$key." ".$value['acc']." '".$value['value']."' ";
					}
				}
			}else{$consul = "1";}
			$valor = implode(",", $this->rules);
			$query = $this->query("SELECT $valor FROM $this->tableName WHERE $consul $at");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{return '';}
		}
		public function insData($array){
			$sql  = "INSERT INTO $this->tableName";
	   		$sql .= " (`".implode("`, `", array_keys($array))."`)";
	   		$sql .= " VALUES ('".implode("', '", $array)."') ";
	   		$this->query($sql);
		}
		public function upData($array,$where){
			$sql = "UPDATE $this->tableName SET ";
			$sql .= implode("`, `", array_keys($array))." = '".implode("', '", $array)."' WHERE ";
			$sql .= implode("`, `", array_keys($where))." = '".implode("', '", $where)."';";
			$this->query($sql);
		}
		public function dlData($where){
			if(is_array($where)){
				foreach ($where as $key => $value) {
					if(!is_array($value)){
						$consul = $key." = '".$value."' ";
					}else{
						$consul .= $value['con']." ".$key." ".$value['acc']." '".$value['value']."' ";
					}
				}
			}
			$sql = "DELETE FROM $this->tableName WHERE $consul";
			$this->query($sql);
		}
		public function query($sql){
			$resultado = mysql_query($sql,$this->conexion);
			if (!$resultado) {
				echo "Error mysql ".mysql_error();
				exit();
			}
			return $resultado;
		}
		function numero_de_filas($result){
			if(!is_resource($result)) return false;
			return mysql_num_rows($result);
		}
		function fetch_assoc($result){
			if(!is_resource($result)) return false;
			return mysql_fetch_assoc($result);
		}
		function fetch_array($result){
			if(!is_resource($result)) return false;
			return mysql_fetch_array($result);
		}
		function __destruct(){mysql_close();}
	}
?>