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
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Data de Cadastro</th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($produto->result() as $prod){
                        $html = "<tr>";
                        $html .= "<td>".$prod->idProduto."</td>";
                        $html .= "<td>".$prod->descricaoProduto."</td>";
                        $html .= "<td>R$ ".$prod->valorProduto."</td>";
                        $html .= "<td>".$prod->quantidadeProduto."</td>";
                        $html .= "<td>".date("d-m-Y", strtotime($prod->dataCadastro))."</td>";
                        $html .= "<td><a href='".site_url('produto/editarProduto/'.$prod->idProduto)."'><i class=\"fas fa-edit\"></i></a>";
                        $html .= "<td><a href='".site_url('produto/deletarProduto/'.$prod->idProduto)."'><i class=\"fas fa-times\"></i></a>";
                        $html .= "</tr>";
                        echo $html;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
