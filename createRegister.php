<?php
	include("backend/connection.php");

	//Check if form was send
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		//Make a security form
		function anti_injection($data) {
			$data = stripslashes($data); //Un-quotes a quoted string
			$data = htmlspecialchars($data); //Transform data from symbos to secure form of Cross-site scripting (XSS)
			$data = strip_tags($data); //Remove tags html
			$data = trim($data); //Strip whitespace (or other characters) from the beginning and end of a string
			return $data;
		}
		$name											= anti_injection($_POST["name"]);
		$email											= anti_injection($_POST["email"]);
		$confirmEmail									= anti_injection($_POST["confirmEmail"]);
		$phone											= anti_injection($_POST["phone"]);
		$phone											= str_replace(['(', ')', '-', ' ', ':', '*'], '', $phone);
		$cpf											= anti_injection($_POST["cpf"]);
		$cpf											= str_replace(['.', '-'], '', $cpf);
		$dtm_register									= date('Y-m-d H:i:s');

		function emailcheck($email){
			try {
				//Check If Email Exists
				include("backend/connection.php");

				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				//Set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//Define sql query
				$sql = "SELECT email FROM register WHERE email = :email";
				//Prepare statement
				$stmt = $conn->prepare($sql);
				$stmt->bindValue(":email", $email, PDO::PARAM_STR);
				//Execute the query
				$stmt->execute();
				//Set the resulting array to associative
				$dataemail = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				$dataemail = $stmt->fetch();

				if ($dataemail[email] === $email){
					return 1;
				} else {
					return 0;
				}

			} catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
		}

		if (emailcheck($email) == 1) {
			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Oh não!</strong> Este email já foi cadastrado!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"><i class="bi-x"></i></span>
				</button>
			</div>';
			http_response_code(401);
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			//check if e-mail address is well-formed
			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				O email não é válido!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="bi-x"></i></span>
				</button>
			</div>';
			http_response_code(401);
		} elseif ($email != $confirmEmail) {
			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Os emails digitados não são iguais!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="bi-x"></i></span>
				</button>
			</div>';
			http_response_code(401);
		} elseif (strlen($name) < 6 || strlen($email) < 10 ||
			strlen($confirmEmail) < 10 || strlen($cpf) < 11) {
			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Um ou mais campos não atingiram o mínimo de caracteres necessários para o cadastro!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="bi-x"></i></span>
				</button>
			</div>';
			http_response_code(401);
		} elseif (strlen($phone) != 10) {
			echo '
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				O Telefone não tem exatamente 10 caracteres!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"><i class="bi-x"></i></span>
				</button>
			</div>';
			http_response_code(401);
		} else {

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				//Set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//Define sql query
				$sql = "INSERT INTO register (name, email, phone, cpf, dtm_register)
				values (:name, :email, :phone, :cpf, :dtm_register)";

				//Prepare statement
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindValue(":phone", $phone, PDO::PARAM_INT);
				$stmt->bindValue(":cpf", $cpf, PDO::PARAM_INT);
				$stmt->bindValue(":dtm_register", $dtm_register, PDO::PARAM_STR);

				//Execute the query
				$stmt->execute();

				echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Tudo certo!</strong> Seu cadastro foi realizado!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="bi-x"></i></span>
					</button>
				</div>';

				http_response_code(200);

			} catch(PDOException $e) {
				echo '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Error: </strong>'
					. $e->getMessage() . 				
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="bi-x"></i></span>
					</button>
				</div>';
				http_response_code(401);
			}
			$conn = null;
		}
	}
?>
