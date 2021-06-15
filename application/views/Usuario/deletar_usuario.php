<div class="card mb-3">
    <div class="card-header">Você está certo disso? Não há retorno.</div>
    <div class="card-body">
	<div class="container">
		    <form method="POST" action="<?= site_url('usuario/deletarUsuario')?>">
		    <div class="form-group">
                <div class="form-label-group">
                    <input type="text" class="form-control" id="senhaAtual" name="senhaAtual" placeholder="Senha" required>
                    <label for="senhaAtual">Confirmar Senha</label>
                </div>
		    </div>
		    <button type="submit" class="btn btn-primary">Excluir</button>
        </form>
	</div>
    </div>
</div>