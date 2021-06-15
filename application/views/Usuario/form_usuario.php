<div class="card mb-3">
    <div class="card-header">Alterar Dados da Conta</div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="<?= site_url('usuario/atualizarUsuario')?>">
                    <div class="form-group">
                        <label for="nomeCompletoUsuario">Nome Completo:</label>
                        <input type="text" class="form-control" id="nomeCompletoUsuario" name="nomeCompletoUsuario" placeholder="Nome Completo" value="<?= $dadosUsuario->nomeCompletoUsuario ?>" required>
                    </div>
                <div class="form-group">
                    <label for="nomeUsuario">Nome de Usuario:</label>
                    <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" placeholder="Nome de Usuario" value="<?= $dadosUsuario->nomeUsuario ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="emailUsuario" name="emailUsuario" aria-describedby="emailHelp" placeholder="Email" value="<?= $dadosUsuario->emailUsuario ?> "required>
                </div>
                <div class="form-group">
                    <label for="novaSenha">Nova Senha:</label>
                    <input type="password" class="form-control" id="novaSenha" name="novaSenha" placeholder="Senha">
                </div>
                <div class="form-group">
                    <label for="senhaAtual">Senha Atual:</label>
                    <input type="password" class="form-control" id="senhaAtual" name="senhaAtual" placeholder="Senha Atual" required>
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>

                <a class="d-block" href="<?= site_url('usuario/excluirConta')?>">Excluir a conta</a>
        </form>
	    </div>
    </div>
</div>