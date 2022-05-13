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

    <section class="container">
      <div class="jumbotron bg-transparent">
        <h1 class="display-4">Bem vindo</h1>
        <hr class="mt-4">
      </div>
      <div class="row ">
        <div class="col-sm-6 pr-sm-4">
          <h4>Registros</h4>
          <p class="lead mt-3">Cadastre as informações de seus usuários, visualize detalhes, edite e exclua. Tudo em um único lugar, aproveite.</p>
        </div>
        <div class="col-sm-6 mt-4 mt-sm-0 pl-sm-4">
          <h4>Relatórios</h4>
          <p class="lead mt-3">Nosso sistema conta com relátorio de todos os cadastros realizados.</p>
        </div>
      </div>
    </section>

    <!-- Footer section-->
    <?php include("footer.php"); ?>

    <!-- Jquery -->
    <script src="components/jquery/jquery.min.js"></script>
    <!-- Bootstrap javascript base -->
    <script src="components/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
