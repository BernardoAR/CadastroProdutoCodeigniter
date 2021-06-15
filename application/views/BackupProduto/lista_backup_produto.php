<div class="card mb-3">
    <div class="card-header">Backup dos Produtos</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Quantidade</th>
                        <th>Data de Cadastro</th>
                        <th>Data de Atualização</th>
                        <th>Data de Exclusão</th>
                        <th>ID do Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($produto->result() as $prod) :
                    ?>

                        <tr>
                            <td><?= $prod->idProduto ?></td>
                            <td><?= $prod->descricaoProduto ?></td>
                            <td>R$<?= $prod->valorProduto ?></td>
                            <td><?= $prod->quantidadeProduto ?></td>
                            <td><?= date("d-m-Y", strtotime($prod->dataCadastro)) ?></td>
                            <td><?= date("d-m-Y", strtotime($prod->dataAtualizacao)) ?></td>
                            <td><?= (($prod->dataExclusao == null) || ($prod->dataExclusao == '0000-00-00')) ? 'Sem Data' : date("d-m-Y", strtotime($prod->dataExclusao)) ?></td>
                            <td><?= $prod->idUsuario ?></td>
                            <td></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>