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

    
    <script src="../js/p3.js">

    </script>
    <script src="../js/igorescobar-jQuery-Mask-Plugin-2c1f36f/jquery.mask.js">

    </script> 


  </head>
  <body style="background:#212529;">
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
      <div class="container">
        <a href="index.html" class="navbar-brand logo" ></a>

        <button class="navbar-toggler" type="button" data-toggle ="collapse" data-target= "#biblioteca">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="biblioteca">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"> <a class="nav-link" href="index.php">Voltar</a> </li>

          </ul>
        </div>


        

      </div>
  </nav>
    <div class="margem-navbar">
        <section class="container" style="background:#F2F2F2;height : 1000px; border-radius:50px;padding:50px;">
        
        <div class="row">

        <div class="col-md-2">
          <div class="form-group">
            <label for="formGroupExampleInput">Quantidade inicial</label>
            <input type="number" class="form-control" id="qtdInicial" placeholder="EX: 1" style="background:#FAFAFA;">
          </div>
        </div>

        <div class="col-md-2">
           <div class="form-group">
            <label for="formGroupExampleInput">Quantidade final</label>
            <input type="number" class="form-control" id="qtdFinal" placeholder="EX: 50" style="background:#FAFAFA;">
        </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
          <label for="formGroupExampleInput">Valor inicial</label>
            <input type="number" class="form-control" id="valorInicial" placeholder="Valor inicial" style="background:#FAFAFA;">
          </div>
        </div>

        <div class="col-md-2">
           <div class="form-group">
           <label for="formGroupExampleInput">Valor final</label>
            <input type="number" class="form-control" id="valorFinal" placeholder="Valor final" style="background:#FAFAFA;">
        </div>

        

        </div>
        <div class="row"style="margin-bottom: 30px;">
          
            <div class="col-md-1"> 
            <label for="formGroupExampleInput"></label>
              <a class="btn btn-danger" id="buscar">BUSCAR</a>
            </div>
          </div>

        </div>
        
        <div id="lista">  
        
        </section>
    </div>
    
  </body>
</html>