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
    <?php include("nav.php"); ?>

    <div class="container">
      <div class="pt-5 pb-3">
        <div id="txtHint"></div>
        <h2>Cadastro de usuário</h2>
        <p class="lead mt-3">Cadastre suas informações agora.</p>
      </div>

      <form class="needs-validation row justify-content-center" method="post" enctype="multipart/form-data" name="formRegister" id="formRegister" novalidate>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control register" name="name" id="name" placeholder="Digite seu nome" autofocus="autofocus" required>
            <div class="invalid-feedback">
              Digite um nome válido.
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control register" name="email" id="email" placeholder="nome@exemplo.com" required>
            <div class="invalid-feedback">
              Digite um email válido.
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="confirmEmail">Confirme o Email</label>
            <input type="email" class="form-control register" name="confirmEmail" id="confirmEmail" placeholder="nome@exemplo.com" required>
            <div class="invalid-feedback">
              Digite um email válido.
            </div>
          </div>
          <div class="mb-3">
            <label for="phone">Telefone</label>
            <input type="phone" class="form-control register" name="phone" id="phone" placeholder="(11) 8765-4321" required>
            <div class="invalid-feedback">
              Digite um telefone válido.
            </div>
          </div>
        </div>
      
        <div class="col-12 col-md-6 mr-auto">
          <div class="mb-3">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control register" name="cpf" id="cpf" placeholder="Digite seu CPF" minlength="" maxlength="" required>
            <div class="invalid-feedback">
              Entre com um CPF válido.
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-5 col-xl-4 mt-4">
          <button class="btn btn-success btn-lg btn-block col-centered" type="submit">Cadastrar</button>
        </div>
        <div class="col-md-1 col-xl-1">
        </div>
      
        <!-- <hr class="mb-4"> -->
      </form>
    </div>

    <!-- Footer section-->
    <?php include("footer.php"); ?>

    <!-- Jquery -->
    <script src="components/jquery/jquery.min.js"></script>
    <!-- Bootstrap javascript base -->
    <script src="components/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ImaskJS plugin -->
    <script src="https://unpkg.com/imask"></script>
    <!-- Bootstrap form validation -->
    <script src="form-validation.js"></script>
    <!-- Custom scripts -->
    <script src="frontend/js/scriptRegister.js"></script>
  </body>
</html>
