<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="<?= site_url('Sistema') ?>">Logotipo</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $usuario->nomeCompleto ?>
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= site_url('Usuario') ?>">Alterar Dados</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= site_url('Login/deslogar') ?>"">Sair</a>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">

                        <!-- Sidebar -->
                        <ul class="sidebar navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= site_url('Sistema') ?>">
                                    <i class="fas fa-home"></i>
                                    <span>Início</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="produtoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-clipboard"></i>
                                    <span>Produtos</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="produtoDropdown">
                                    <a class="dropdown-item" href="<?= site_url('Produto') ?>">Listar Produtos</a>
                                    <a class="dropdown-item" href="<?= site_url('Produto/novoProduto') ?>">Cadastrar Produtos</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="backupProdutoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cloud"></i>
                                    <span>Backup Produtos</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="backupProdutoDropdown">
                                    <a class="dropdown-item" href="<?= site_url('BackupProduto') ?>">Listar Backup</a>
                                </div>
                            </li>
                        </ul>

                        <div id="content-wrapper">

                            <div class="container-fluid">
                                <?= gerarBreadcrumb() ?>
                                <!-- Breadcrumbs e Mensagem-->
                                <?= $mensagem ?>