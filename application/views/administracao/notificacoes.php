<!DOCTYPE html>
<html lang="en">
<head>
  <title>APAE - Administração</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
</head>

<body>

<nav class="navbar navbar-expand-sm bg-light navbar-light" style=" margin-bottom: 5%;">
  <ul style="padding-left: 10%;" class="navbar-nav">
    <li class="nav-item">
      <img src="<?=base_url('assets/images/ap.jpeg')?>" height="50" width="100"> 
    </li>
   </ul>
   <ul style="padding-left: 40%;" class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?=site_url('administracao/')?>">Finanças</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="<?=site_url('administracao/notificacoes')?>">Eventos</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="<?=site_url('administracao/qrcode')?>">Leitor de QR Code</a>
    </li>
    <li style="background-color:#adebeb;" class="nav-item">
      <a class="nav-link disabled" href="<?=site_url('auth/logoff')?>">Sair</a>
    </li>
  </ul>
</nav>



<div id = formEventos style="max-width: 80%; vertical-align: middle; padding-left: 20%;">
<h4 class="pb-3">Notifique todos os eventos para os e-mails cadastrados no sistema:</h4>
<form method="POST" action="<?=site_url('administracao/notificar')?>">
  <div class="form-group">
    <label for="nomeEvento">Nome do Evento</label>
    <input name="nome_evento" type="text" class="form-control" placeholder="Digite o nome do evento" required>
  </div>
  <div class="form-group">
    <label for="data">Data do Evento</label>
    <input name="data_evento" type="text" class="form-control date" required>
  </div>
  
    <label for="data">Descrição</label>
    <textarea name="descricao_evento" type="text" class="form-control" placeholder="Descreva brevemente o evento." required></textarea>
 
  <button id="butNotificar" onclick="confirm" style="margin-top: 3%; margin-left: 60%;" type="submit" class="btn btn-success">Enviar para todos os colaboradores</button>

</form>
</div>


</body>

</html>
<script>
    $(document).ready(function() {
        $(".date").val(GetTodayDate())
    })
    
    function GetTodayDate() {
       var tdate = new Date();
       var dd = tdate.getDate(); //yields day
       var MM = tdate.getMonth(); //yields month
       var yyyy = tdate.getFullYear(); //yields year
       var currentDate= dd + "/" +( MM+1) + "/" + yyyy;

       return currentDate;
    }
</script>
