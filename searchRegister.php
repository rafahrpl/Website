<?php
	include("backend/connection.php");

	//Check if form was send
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){

		//Make a security form
		function anti_injection($data) {
			$data = stripslashes($data); //Un-quotes a quoted string
			$data = htmlspecialchars($data); //Transform data from symbos to secure form of Cross-site scripting (XSS)
			$data = strip_tags($data); //Remove tags html
			$data = trim($data); //Strip whitespace (or other characters) from the beginning and end of a string
			return $data;
		}
		$keyword										= anti_injection($_GET["keyword"]);
		$value											= anti_injection($_GET["value"]);

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			//Set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//Define sql query
			$sql = "SELECT name, email, phone, cpf, dtm_register FROM register WHERE $keyword LIKE '%".$value."%'";
			if($keyword == "cpf"){
				$sql = "SELECT name, email, phone, cpf, dtm_register FROM register WHERE cpf = ".$value."";
			}
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			//Set the resulting array to associative
			$results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;

		foreach($results as $register){
			$phone = "(".substr($register[phone],0,2).") ".substr($register[phone],2,4)."-".substr($register[phone],6,4);
			$cpf = substr($register[cpf],0,3).".".substr($register[cpf],3,3).".".substr($register[cpf],6,3)."-".substr($register[cpf],9,2);
			echo '<tr>
			<td>'.$register[name].'</td>
			<td>'.$register[email].'</td>
			<td>'.$phone.'</td>
			<td>'.$cpf.'</td>
			<td class="text"><a href="registerView.php?email='.$register[email].'"><i class="bi-eye-fill text-info mr-3"></i></a>
			<a href="registerEdit.php?email='.$register[email].'"><i class="bi-pencil-fill text-info mr-3"></i></a>
			<a id="'.$register[email].'" href="" onclick="deletert(this.id)"><i class="bi-trash-fill text-danger"></i></a></td>
			</tr>'; 
		}
	}
?>
