<!DOCTYPE html>
<html lang="en">
<head>
  <title>APAE - Administração</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> 
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
    <li class="nav-item">
      <a class="nav-link" href="<?=site_url('administracao/notificacoes')?>">Eventos</a>
    </li>
     <li class="nav-item active">
      <a class="nav-link" href="<?=site_url('administracao/qrcode')?>">Leitor de QR Code</a>
    </li>
    <li style="background-color:#adebeb;" class="nav-item">
      <a class="nav-link disabled" href="<?=site_url('auth/logoff')?>">Sair</a>
    </li>
  </ul>
</nav>
    <div id = "custo" style="margin: 3%;">
    <label for="name">Custo</label>
    <input name="valor" id="valor" class="form-control" placeholder="Digite o valor a ser descontado" required autofocus>
      </div>
    <video id="preview"></video>
    <script type="text/javascript">
      $(document).ready(function(){
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        alert(content);
        $.ajax({
            type:'POST',
            data:{id: content, price: $('#valor').val()},
            dataType: 'json',
            url:"<?=site_url('administracao/cobrar')?>",
            success: function(data){
              console.log(data);
              if(data == 'err'){
                alert("Erro ao realizar transação")    
              } else {
                if(parseInt(data) < 0){
                    alert("O comprador está devendo "+(parseInt(data) * -1))
                } else {
                    alert("Compra efetuada com sucesso!")
                }
              }
              
            }
        });
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
          
    })
    </script>

</body>
</html>