<div class="card mb-3">
    <div class="card-header">Produtos Cadastrados</div>
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
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($produto->result() as $prod) : ?>
                        <tr>
                            <td><?= $prod->idProduto ?></td>
                            <td><?= $prod->descricaoProduto ?></td>
                            <td><?= $prod->valorProduto ?></td>
                            <td><?= $prod->quantidadeProduto ?></td>
                            <td><?= date("d-m-Y", strtotime($prod->dataCadastro)) ?></td>
                            <td><a href="<?= site_url('produto/editarProduto/' . $prod->idProduto) ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="<?= site_url('produto/deletarProduto/' . $prod->idProduto) ?>"><i class="fas fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>