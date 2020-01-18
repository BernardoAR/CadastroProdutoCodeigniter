<body>
    <div class="card mb-3">
        <div class="card-header">
            <?php
            if ($produto->idProduto == null) {
                echo "Cadastrar Produto";
            } else {
                echo "Alterar Produto";
            }
            ?>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="<?= site_url('Produto/gravarProduto/' . $produto->idProduto) ?>">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" class="form-control" id="descricaoProduto" name="descricaoProduto" placeholder="Descricao do Produto" value="<?= $produto->descricaoProduto ?>" required>
                            <label for="descricaoProduto">Descrição do Produto:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="number" class="form-control" id="valorProduto" name="valorProduto" placeholder="Valor do Produto" step="any" value="<?= $produto->valorProduto ?>" required>
                            <label for="valorProduto">Valor do Produto (em R$):</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="number" class="form-control" id="quantidadeProduto" name="quantidadeProduto" placeholder="Quantidade do Produto" value="<?= $produto->quantidadeProduto ?>" required>
                            <label for="quantidadeProduto">Quantidade do Produto:</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <?php

                        if ($produto->idProduto == null) {
                            echo "Cadastrar Produto";
                        } else {
                            echo "Alterar Produto";
                        }
                        ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?= script_tag('assets/bootstrap/js/jquery.maskMoney.min.js');
