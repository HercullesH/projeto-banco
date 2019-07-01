<?php

  $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
  
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style type="text/css">
       
    </style>
     

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../styles/index.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">




    <title>Alunos</title>

    
    <script src="../js/index.js">

    </script>
    <script src="../js/igorescobar-jQuery-Mask-Plugin-2c1f36f/jquery.mask.js">

    </script> 


  </head>
  <body>
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
      <div class="container">
        <a href="index.html" class="navbar-brand logo" ></a>

        <button class="navbar-toggler" type="button" data-toggle ="collapse" data-target= "#biblioteca">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="biblioteca">
          <ul class="navbar-nav mr-auto">

          </ul>

          <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <li class="dropdown order-1 <?= $erro == 1 ? 'show' : '' ?>">
                    <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle" >Login <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right mt-2 <?= $erro == 1 ? 'show' : '' ?>">
                       <li class="px-3 py-2">
                           <form class="form" role="form" method="post" action="../php/valida_login.php">
                                <div class="form-group">
                                    <input id="emailInput" placeholder="Email" class="form-control form-control-sm" type="text" required="Preencha o campo de email" name="email">
                                </div>
                                <div class="form-group">
                                    <input id="passwordInput" placeholder="Password" class="form-control form-control-sm" type="password" required="Preencha o campo de senha" name="senha">
                                </div>
                                <div class="form-group">
                                  <select class="custom-select" id="tipoConta" name="tipo_conta">
                                    <option selected value="">Tipo</option>
                                    <option value="1">Aluno</option>
                                    <option value="2">Professor</option>
                                    <option value="3">Funcionário</option>
                                  </select>
                                </div>
                              
                                <div class="form-group">
                                    <button id="btn_logar" type="submit" class="btn btn-primary btn-block">Login</button>
                                </div>

                                <?php
                                  if($erro == 1){
                                    echo '<font color="#FF0000">Usuário e ou senha inválido(s)</font>';
                                  }
                                ?>
                                
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>


        

      </div>
  </nav>
  </div>
    <div class="margem-navbar">
        <section class="container">

        <div class="row">
          <div class="col-md-2">Pergunta 1 a fácil</div>
          <div class="col-md-2">Pergunta 1.1</div>
          <div class="col-md-2">Pergunta 1.2</div>
          <div class="col-md-2">Pergunta 4</div>
          <div class="col-md-2">Pergunta 5</div>

        </div>

        <div class="row">
          <div class="col-md-2"><a href="p1.php?1?PE" class="btn btn-success">entrar</a></div>
          <div class="col-md-2"><a href="p2.php?1?-1?-1" class="btn btn-success">entrar</a></div>
          <div class="col-md-2"><a href="p3.php?1?-1?-1" class="btn btn-success">entrar</a></div>
          <div class="col-md-2"><a href="p4.php" class="btn btn-success">entrar</a></div>
          <div class="col-md-2"><a href="p5.php" class="btn btn-success">entrar</a></div>
        </div>

        </section>
    </div>
    
  </body>
</html>