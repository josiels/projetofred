<!DOCTYPE html>
<html>
  <head>
    <title>RN CRONO - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
    </div>
    <div class="page-content container">
        <div class="row">
            <div class="col-md-4 col-md-offset-1" style="text-align: center;font-size: 9pt;">
                <figure>
                    <img src="img/logo_rncrono.png" alt="Logo RN CRONO">
                    <figcaption></figcaption>
                </figure>
            </div>
            <div class="col-md-4">
                <div class="login-wrapper">
                    <div class="box">
                        <div class="content-wrap">
                            <h6>Acesso administrador</h6>
                            <form id="" name="" action="validalogin" method="POST">
                                <input class="form-control" type="text" autocomplete="off" autofocus name="login" placeholder="Login">
                                <input class="form-control" type="password" name="senha" placeholder="*****">
                                <div class="action">
                                    <input class="btn btn-primary signup" type="submit" name="logar" value="Acessar" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="already">
                        <p>Sistema de administração de eventos do RN CRONO <?=date("Y")?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-1">

            </div>

        </div>
    </div>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
