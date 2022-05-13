<?php
	include("backend/connection.php");

	//Check if form was send
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $email = $_GET["email"];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      //Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //Define sql query
      $sql = "SELECT name, email, phone, cpf, dtm_register FROM register WHERE email = :email";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();

      //Set the resulting array to associative
      $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $results = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $conn = null;
    
    $user = (object) $results[0];
	}
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

    <!-- Report section -->
    <section>
      <div class="container">
        <div id="txtHint"></div>
				<div class="row mt-5">
         	<div class="col-lg-12 mx-auto">
           <h2 class="mb-4"><?php echo $user->name; ?></h2>
            <div class="table-responsive-md">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <td>Nome</td>
                      <?php echo '<td>'.$user->name.'</td>'; ?>
                  </tr>
                  <tr>
                    <td>Email</td>
                      <?php echo '<td>'.$user->email.'</td>'; ?>
                  </tr>
                  <tr>
                    <td>Telefone</td>
                      <?php
                        $phone = "(".substr($user->phone,0,2).") ".substr($user->phone,2,4)."-".substr($user->phone,6,4);
                        echo '<td>'.$phone.'</td>';
                      ?>
                  </tr>
                  <tr>
                    <td>CPF</td>
                    <?php
                      $cpf = substr($user->cpf,0,3).".".substr($user->cpf,3,3).".".substr($user->cpf,6,3)."-".substr($user->cpf,9,2);
                      echo '<td>'.$cpf.'</td>';
                    ?>
                  </tr>
                  <tr>
                    <td>Data de criação</td>
                    <?php
                      echo '<td>'.$user->dtm_register.'</td>';
                    ?>
                  </tr>
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
    <script src="frontend/js/scriptRegisterView.js"></script>
  </body>
</html>
