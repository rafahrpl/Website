<?php
  include("backend/connection.php");

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		//Set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Define sql query
    $sql = "SELECT name, email, phone, cpf, dtm_register FROM register";
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
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="Cadastro de usuário"/>
    <meta name="author" content="Raphael Alves"/>
    <title>Site</title>
    <link rel="icon" href="favicon.png" sizes="32x32" type="image/png"/>
    <!-- Lato and Montserrat fonts -->
		<link href="frontend/css/fonts.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap core CSS -->
    <link href="components/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Custom style -->
    <link rel="stylesheet" href="frontend/css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  </head>
  <body>
    <!-- Navigation section-->
    <?php include("nav.php") ?>

    <!-- Search section -->
    <section class="mt-4">
      <div class="container">
        <form id="formRegister" novalidate>
          <div class="row input-group input-group-lg">
            <div class="col-12 col-sm-5">
              <label for="type">Selecione o campo para pesquisa:</label>
              <div class="input-group input-group-lg">
                <select name="type" id="type" class="form-control input-lg searchRegister">
                  <option value="name" selected>Nome</option>
                  <option value="email">Email</option>
                  <option value="phone">Telefone</option>
                  <option value="cpf">CPF</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-sm-7">
              <div class="input-group input-group-lg mt-4 pt-2">
                <input type="text" id="change" class="form-control searchRegister" name="change" placeholder="Digite seu nome" autofocus="autofocus">
                <div class="input-group-btn">
                  <button class="btn btn-success btn-lg" type="submit"><i class="bi-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>

    <!-- Report section -->
    <section>
      <div class="container">
        <div id="txtHint"></div>
				<div class="row mt-5">
         	<div class="col-lg-12 mx-auto">

            <div class="table-responsive-md">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Editar</th>
                  </tr>
                </thead>
                <tbody id="responseTable">
                    <?php
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
                    ?>
                </tbody>
              </table>
            </div>
       		</div>
        </div>
			</div>
		</section>
		<!-- End section -->
    
    <!-- Footer section-->
    <?php include("footer.php") ?>

    <!-- Jquery -->
    <script src="components/jquery/jquery.min.js"></script>
    <!-- Bootstrap javascript base -->
    <script src="components/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ImaskJS plugin -->
    <script src="https://unpkg.com/imask"></script>
    <!-- Bootstrap form validation -->
    <script src="form-validation.js"></script>
    <!-- Custom scripts -->
    <script src="frontend/js/scriptReport.js"></script>
  </body>
</html>
