<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Login APAE</title>
          <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
    </head>

    <body id="bodyLogin">

    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="<?=base_url('assets/images/apae.jpg')?>" />
            <?php if(isset($status)) echo $status;?>
            <form class="form-signin" action="<?=site_url('auth/logar')?>" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="email" name="email_usuario" class="form-control" placeholder="Usuário" required autofocus>
                <input type="password" name="cpf_usuario" id="inputPassword" class="form-control" placeholder="Senha" required>
                <a href="pontos.html">
                    <button style="margin-top: 5%;" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
                </a>
            </form><!-- /form -->
        </div><!-- /card-container -->

    </div><!-- /container -->

</body>
</html>