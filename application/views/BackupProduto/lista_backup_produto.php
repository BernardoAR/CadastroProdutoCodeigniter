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
                <tfoot>
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
                    $html .= "<td>".date("d-m-Y", strtotime($prod->dataAtualizacao))."</td>";
                    if($prod->dataExclusao != null){
                        $html .= "<td>".date("d-m-Y", strtotime($prod->dataExclusao))."</td>";
                    } else {
                        $html .= "<td>".$prod->dataExclusao."</td>";
                    }
                    $html .= "<td>".$prod->idUsuario."</td>";
                    $html .= "</tr>";
                    echo $html;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

