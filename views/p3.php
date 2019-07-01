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
  <body>
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
        <section class="container">
        
        <div class="row">

        <div class="col-md-2">
          <div class="form-group">
            <label for="formGroupExampleInput">Quantidade inicial</label>
            <input type="number" class="form-control" id="qtdInicial" placeholder="Example input">
          </div>
        </div>

        <div class="col-md-2">
           <div class="form-group">
            <label for="formGroupExampleInput">Quantidade final</label>
            <input type="number" class="form-control" id="qtdFinal" placeholder="Example input">
        </div>
        </div>

          <div class="col-md-3">
            <form>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                  <select class="form-control" id="estado">
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                </select>
            </div>
            </form>
          </div>

        </div>
        <div class="row"style="margin-bottom: 30px;">
          <div class="col-md-5"></div>
            <div class="col-md-1"> 
              <a class="btn btn-success" id="buscar">BUSCAR</a>
            </div>
          </div>
        <div id="lista">

        </div>
        
        </section>
    </div>
    
  </body>
</html>