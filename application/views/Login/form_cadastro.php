<body class="bg-dark">

<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Cadastro</div>
        <div class="card-body">
            <form method="POST" action="<?= site_url('login/cadastrarUsuario')?>">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="nomeCompletoUsuario" name="nomeCompletoUsuario" class="form-control" placeholder="Nome Completo" required="required">
                        <label for="nomeCompletoUsuario">Nome Completo</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" placeholder="Nome de Usuário" required="required">
                        <label for="nomeUsuario">Nome de Usuário</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="emailUsuario" name="emailUsuario" class="form-control" placeholder="Email" required="required">
                        <label for="emailUsuario">Email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="senhaUsuario" id="senhaUsuario" name="senhaUsuario" class="form-control" placeholder="Senha" required="required">
                                <label for="senhaUsuario">Senha</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="confSenha" name="confSenha" class="form-control" placeholder="Confirmar Senha" required="required">
                                <label for="confSenha">Confirmar Senha</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= site_url('login')?>">Voltar</a>
            </div>
        </div>
    </div>
</div>
</body>