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
    if(count($results[0])==0){
      header("Location: report.php");
    }
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

    <div class="container">
      <div class="pt-5 pb-3">
        <div id="txtHint"></div>
        <h2>Edição de cadastro</h2>
        <p class="lead mt-3">Edite suas informações de cadastro agora.</p>
      </div>

      <form class="needs-validation row justify-content-center" method="put" enctype="multipart/form-data" name="formRegister" id="formRegister" novalidate>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control register" name="name" id="name" placeholder="Digite seu nome" value="<?php echo $user->name; ?>" autofocus="autofocus" required>
            <div class="invalid-feedback">
              Digite um nome válido.
            </div>
          </div>
          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control register" name="email" id="email" placeholder="nome@exemplo.com" value="<?php echo $user->email; ?>" required>
            <div class="invalid-feedback">
              Digite um email válido.
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="confirmEmail">Confirme o Email</label>
            <input type="email" class="form-control register" name="confirmEmail" id="confirmEmail" placeholder="nome@exemplo.com" value="<?php echo $user->email; ?>" required>
            <div class="invalid-feedback">
              Digite um email válido.
            </div>
          </div>
          <div class="mb-3">
            <label for="phone">Telefone</label>
            <input type="phone" class="form-control register" name="phone" id="phone" placeholder="(11) 8765-4321" value="<?php echo $user->phone; ?>" required>
            <div class="invalid-feedback">
              Digite um telefone válido.
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 mr-auto">
          <div class="mb-3">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control register" name="cpf" id="cpf" placeholder="Digite seu CPF" value="<?php echo $user->cpf; ?>" required>
            <div class="invalid-feedback">
              Entre com um CPF válido.
            </div>
          </div>
        </div>
        <input type="hidden" class="register" name="oldEmail" value="<?php echo $user->email; ?>">
        <div class="col-sm-6 col-md-5 col-xl-4 mt-4">
          <button class="btn btn-success btn-lg btn-block col-centered" type="submit">Cadastrar</button>
        </div>
        <div class="col-md-1 col-xl-1">
        </div>
        
        <!-- <hr class="mb-4"> -->
      </form>
    </div>

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
    <script src="frontend/js/scriptRegisterEdit.js"></script>
  </body>
</html>
