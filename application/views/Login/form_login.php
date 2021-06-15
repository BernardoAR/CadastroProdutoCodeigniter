<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="POST" action="<?= site_url('login/autenticar')?>">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" placeholder="Nome de Usuário" required="required" autofocus="autofocus">
                        <label for="nomeUsuario">Nome de Usuário</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="senhaUsuario" name="senhaUsuario" class="form-control" placeholder="Senha" required="required">
                        <label for="senhaUsuario">Senha</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= site_url('login/novoUsuario')?>">Cadastre-se</a>
            </div>
        </div>
    </div>
</div>