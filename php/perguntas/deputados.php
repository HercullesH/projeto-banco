<?php

require_once('../../classes/Database.class.php');
require_once('../../classes/Paginacao.class.php');

$paginacao = new Paginacao();
$db = new Db();

$paginacao->loadDeputados();

echo '<div class="col-md-6">
<form>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Deputados</label>
      <select class="form-control" id="deputado">
      <option value="TODOS">TODOS</option>';
foreach($paginacao->dados as $i => $dado){
    echo '<option value="'.$dado->id.'">'.$dado->nome.'</option>';
}
echo'
                </select>
            </div>
            </form>
          </div>';
?>