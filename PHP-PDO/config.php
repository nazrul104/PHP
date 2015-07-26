<?php

		/**
		* by Nazrul
		*/
		class Config 
		{
			private $conn="";
			private $username,$password;

			public function __construct()
			{
				$this->username="root";
				$this->password="";
				try {
					    $this->conn = new PDO('mysql:host=localhost;dbname=smart_shop_solution', $this->username, $this->password);
					    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					} catch(PDOException $e) {
					    echo 'ERROR: ' . $e->getMessage();
					}
			}

			public function SetMainCategory()
			{
				try
				 {				 
				  $stmt = $this->conn->prepare('INSERT INTO main_category(main_category_name,main_category_hash_id,created_by)VALUES(:main_category_name,:main_category_hash_id,:created_by)');
				  $stmt->execute(array(
				    ':main_category_name' => 'Electronic Accessories',
				    ':main_category_hash_id'=>md5(time().''.rand(1000,250000000)),
				    ':created_by'=>'Nazrul'
				  ));
				 
				  # Affected Rows?
				  echo $stmt->rowCount(); // 1
				} catch(PDOException $e) {
				  echo 'Error: ' . $e->getMessage();
				}
			}

			public function GetMainCategory()
			{
				$id = 5;
				try
				{
				  $stmt = $this->conn->prepare('SELECT * FROM main_category');
				  $stmt->execute();
				  $result = $stmt->fetchAll();
				 $arr=array();
				  if ( count($result) )
				   { 
				     foreach($result as $row) 
				     { 
				      	$arr[]=$row;
				     }   
				      echo json_encode($arr);
				  } else 
				  {
				    echo 0;
				  }

				} catch(PDOException $e) {
				    echo 'ERROR: ' . $e->getMessage();
				}
			}
			public function Delete()
			{	 
			  $id=1;
			  $stmt = $this->conn->prepare('DELETE FROM main_category WHERE main_category_id = :id');
			  $stmt->bindParam(':id', $id); 
			  $stmt->execute();
			  echo $stmt->rowCount();
			}
			public function GetMainCategoryById()
			{
				$id = 5;
				try
				{
				  $stmt = $this->conn->prepare('SELECT * FROM main_category WHERE id = :id');
				  $stmt->execute(array('id' => $id));
				  $result = $stmt->fetchAll();
				 
				  if ( count($result) ) { 
				    foreach($result as $row) {
				      print_r($row);
				    }   
				  } else {
				    echo "No rows returned.";
				  }
				} catch(PDOException $e) {
				    echo 'ERROR: ' . $e->getMessage();
				}
			}

		}

		$obj=new Config();
		$obj->SetMainCategory();

?>