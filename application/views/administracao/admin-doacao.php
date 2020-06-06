<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8">
  <title>APAE - Administração</title>
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
  <script src="<?=base_url('assets/js/jquery.mask.js')?>"></script>
  <script src="<?=base_url('assets/js/jquery.maskMoney.js')?>"></script>
</head>

<body>

<nav class="navbar navbar-expand-sm bg-light navbar-light" style=" margin-bottom: 5%;">
  <ul style="padding-left: 10%;" class="navbar-nav">
    <li class="nav-item">
       <img src="<?=base_url('assets/images/ap.jpeg')?>" height="50" width="100"> 
    </li>
   </ul>
   <ul style="padding-left: 40%;" class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="<?=site_url('administracao/')?>">Finanças</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?=site_url('administracao/notificacoes')?>">Eventos</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="<?=site_url('administracao/qrcode')?>">Leitor de QR Code</a>
    </li>
    <li style="background-color: #adebeb; paddin: 2%; margin: 0%;" class="nav-item">
      <a class="nav-link disabled" href="<?=site_url('auth/logoff')?>">Sair</a>
    </li>
  </ul>
</nav>
<?php if(isset($status)) echo $status;?>
<div class="container">
    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="histDoacao" data-toggle="tab" href="#nav-histDoacao" role="tab" aria-controls="nav-histDoacao" aria-selected="true">Historico Doacao</a>
    <a class="nav-item nav-link" id="histGasto" data-toggle="tab" href="#nav-histGasto" role="tab" aria-controls="nav-histGasto" aria-selected="false">Histórico Gasto</a>
    <a class="nav-item nav-link" id="doacao" data-toggle="tab" href="#nav-doacao" role="tab" aria-controls="nav-doacao" aria-selected="false">Nova Doação</a>
    <a class="nav-item nav-link" id="gasto" data-toggle="tab" href="#nav-gasto" role="tab" aria-controls="nav-gasto" aria-selected="false">Novo Gasto</a>
    <a class="nav-item nav-link" id="doador" data-toggle="tab" href="#nav-doador" role="tab" aria-controls="nav-doador" aria-selected="false">Novo Doador</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active container" id="nav-histDoacao" role="tabpanel" aria-labelledby="nav-histDoacao">
      <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Data</th>
        <th>Valor (R$)</th>
        <th>Tipo</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($doacoes as $d){ ?>
      <tr>
        <td><?=$d['data_doacoes']?></td>
        <td><?=number_format((float)$d['valor_doacoes'], 2, ',', '')?></td>
        <td><?=$d['tipo_doacoes']?></td>
        <td><?=$d['email_usuario']?></td>
        <td><button data-toggle="modal" data-target="#modal" data-href="<?=site_url("administracao/doacao_del/".$d['id_doacoes'])?>"><i class="far fa-trash-alt"></i></button></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  </div>
  </div>
  
  <div class="tab-pane fade container" id="nav-histGasto" role="tabpanel" aria-labelledby="nav-histGasto">
      <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Valor</th>
        <th>Área</th>
        <th>Data</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($gastos as $g){ ?>
      <tr>
        <td><?=number_format((float)$g['valor_gastos'], 2, ',', '')?></td>
        <td><?=$g['tipo_gastos']?></td>
        <td><?=$g['data_gastos']?></td>
        <td><button data-toggle="modal" data-target="#modal-2" data-href="<?=site_url("administracao/gasto_del/".$g['id_gastos'])?>"><i class="far fa-trash-alt"></i></button></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  </div>
  </div>
  <div class="tab-pane fade container" id="nav-doacao" role="tabpanel" aria-labelledby="nav-doacao">
      <form action="<?=site_url('administracao/nova_doacao')?>" method="POST">
        <div class="form-group">
          <label for="pwd">Tipo</label>
          <select name = "tipo_doacoes" class="form-control formSelec" id="tipo_select" required>
                <option value = "Dinheiro">Dinheiro</option>
                <option value = "Roupa">Roupa</option>
                <option value = "Alimento">Alimento</option>
                <option value = "Voluntario">Voluntario</option>
                <option value = "Outros">Outros</option>
            </select>
        </div>
        <div class="form-group">
          <label for="money">Valor</label>
          <input id="input_tipo" data-thousands="." data-decimal="," class="form-control preco" name="valor_doacoes" placeholder="Digite o valor" required>
          <label for="date">Data</label>
          <input name="data_doacoes" type="text" class="form-control date" required>
        </div>
     
    <div class="form-group">
      <label for="email">Email Doador</label>
      <input type="email" name="email_usuario" class="form-control" placeholder="Digite o email" required>
    </div>
    <button type="submit" class="btn btn-success">Confirmar</button>
  </form>

  </div>
<div class="tab-pane fade container" id="nav-gasto" role="tabpanel" aria-labelledby="nav-gasto">
  <form action="<?=site_url('administracao/novo_gasto')?>" method="POST">
                <div class="form-group">
                      <label for="money">Valor Gasto</label>
                      <input  data-thousands="." data-decimal="," name="valor_gastos" class="form-control preco" placeholder="Valor Gasto" required>
                      <label>Data</label>
                      <input name="data_gastos date" class="form-control date" required>
                      <label for="pwd" style="margin-top:3%">Área</label>
                      <select name = "tipo_gastos" class="form-control" id="area" required>
                            <option value = "Saude">Saúde</option>
                            <option value = "Limpeza">Limpeza</option>
                            <option value = "Alimentacao">Alimentação</option>
                            <option value = "Infraestrutura">Infraestrutura</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Confirmar</button>
          </form>
</div>
<div class="tab-pane fade container" id="nav-doador" role="tabpanel" aria-labelledby="nav-doador">
    <form action="<?=site_url('administracao/novo_doador')?>" method="POST">
        <div class="form-group">
              <label for="name">Nome Completo</label>
              <input name="nome_usuario" class="form-control" placeholder="Nome Completo" required autofocus>
              <label for="name">Email</label>
              <input name="email_usuario" type = 'email' class="form-control" placeholder="exemplo@exemplo.com" required>
              <label for = "cpf">CPF</label>
              <input name="cpf_usuario" type="text" class="form-control" title="CPF possui 11 números (Digite apenas os números)" maxlength="15" required>
        </div>
        <button type="submit" class="btn btn-success">Confirmar</button>
    </form>
</div>
</div>
</div>
 
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-2 d-flex flex-row justify-content-between">
                <h5 class="modal-title" id="modalLabel">Excluir doação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Esta é uma mudança irreversível. Deseja realmente excluir essa doação?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-danger" id="del">Excluir</a>
            </div>
        </div>
    </div>
</div>
    
<!-- Modal -->
<div class="modal fade" id="modal-2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-2 d-flex flex-row justify-content-between">
                <h5 class="modal-title" id="modalLabel">Excluir gasto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Esta é uma mudança irreversível. Deseja realmente excluir esse gasto?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-danger" id="del">Excluir</a>
            </div>
        </div>
    </div>
</div>
    
<script>
    $('#modal').on('show.bs.modal', function(e) {
        $(this).find('#del').attr('href', $(e.relatedTarget).data('href'));
    });
    $('#modal-2').on('show.bs.modal', function(e) {
       
        $(this).find('#del').attr('href', $(e.relatedTarget).data('href'));
    });
    $(document).ready(function() {
        $(".date").val(GetTodayDate());
        $('.date').mask('00/00/0000', {reverse: false});
        $('.preco').maskMoney();
        
        $("#tipo_select").change(function(){
            if($("#tipo_select option:selected").text() != 'Dinheiro'){
                $('#input_tipo').hide()
            } else {
                $('#input_tipo').show()
            }
        });
    })
    
    function GetTodayDate() {
       var tdate = new Date();
       var dd = tdate.getDate(); //yields day
       var MM = tdate.getMonth(); //yields month
       var yyyy = tdate.getFullYear(); //yields year
       var currentDate= dd + "/" +( MM+1) + "/" + yyyy;
       if(dd < 10) currentDate = `${'0'} ${currentDate}`;
       return currentDate;
    }
    
    function cpf_replace(pCpf){
        var cpf = pCpf.toString()

        cpf = cpf.replace(/[\W\s\._\-]+/g, ''); //para retirar caracteres especiais
        cpf = cpf.replace(/[A-z.]+/, ''); //para retirar letras

        //vetor que recebera cada parte do cpf
        var tokens = [];

        //tamanho atual do input
        var tamanho = cpf.length;

        //retirar cada parte do cpf
        for(var i = 0; (i < tamanho) && (i < 9); i+= 3){
            tokens.push(cpf.substr(i, 3));
        }

        //processo de inserção e pontos e traços
        if(tamanho > 9){
            var que = cpf.substr(i, 2);
            cpf = tokens.join(".");
            cpf = cpf + "-" + que;
        }else{
            var cpf = tokens.join(".");
        }

        //substitui no input
        $("#cpf").val(cpf);
    }
    
    </script>

</body>
</html>