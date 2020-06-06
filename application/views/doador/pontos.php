<!DOCTYPE html>
<html lang="en">
<head>
  <title>APAE - Doação</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
</head>
<body>
<div class="ml-5 d-flex justify-content-between align-items-center px-5 col-10">
    <h3 style="margin: 4%;">Confira abaixo o seu histórico de doações:</h3>
    <a href="<?=site_url('auth/logoff')?>" type="button" class="btn btn-info">Sair</a>
</div>


<div id = "historico" class="container">                                                                               
  <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Data</th>
        <th>Tipo</th>
        <th>Valor (R$)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($doaco as $d){ ?>
      <tr>
        <td><?=$d['data_doacoes']?></td>
        <td><?=$d['tipo_doacoes']?></td>
        <td><?if($d['valor_doacoes'] == 0) echo '---'; else echo number_format((float)$d['valor_doacoes'], 2, ',', '');?></td>
      </tr>
      <? }?>
    </tbody>
  </table>
  </div>
</div>	

<div class="card" style="width: 30rem; background-color: #00cc99; vertical-align: middle; padding: 0%; margin-top: 5%;">
  <div style="color: white; text-align: center;" class="card-body">
    <h5 class="card-title" style="width: 100%;">Seus pontos acumulados</h5>
    <h4 class="card-subtitle">R$ <?=number_format((float)$usuario['credito_usuario'], 2, ',', '')?></h4>
    <a type="button" target="_blank" href="<?=site_url('doador/myqr/'.base64_encode($usuario['email_usuario']))?>" style="margin-top:2%" class="btn btn-default">Gerar QR Code</a>
  </div>
</div>

</body>

</html>

