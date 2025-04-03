<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Imóvel Guide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Imóvel Guide</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Cadastro de Corretores</h1>

        <!-- Formulário de Cadastro -->
        <div class="card shadow-lg">
            <div class="card-body">
                <form id="formCorretor" action="/imovelguide/corretores/inserirCorretor" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input class="form-control" type="text" id="nome" name="nome" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input class="form-control" type="text" id="cpf" name="cpf" maxlength="14" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="creci" class="form-label">CRECI</label>
                        <input class="form-control" type="text" id="creci" name="creci" autocomplete="off" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Cadastrar Corretor</button>
                </form>
            </div>
        </div>

        <?php if (!empty($listaCorretores)) { ?>

            <!-- Listagem de Corretores -->
            <div class="card shadow-lg mt-5">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Lista de Corretores</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>CRECI</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaCorretores as $corretor){?>
                                    <tr>
                                        <td><?=$corretor->getNomeCorretor()?></td>
                                        <td><?=$corretor->getCpf()?></td>
                                        <td><?=$corretor->getCreci()?></td>
                                        <td>
                                            <a href="/imovelguide/corretores/alterarCorretor?idcorretor=<?=$corretor->getIdCorretor()?>" class="btn btn-warning btn-sm">Alterar</a>
                                            <a href="/imovelguide/corretores/excluirCorretor/<?=$corretor->getIdCorretor()?>" class="btn btn-danger btn-sm">Excluir</a>
                                        </td>
                                    </tr>
                                <?php }?>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php } else {
            echo "<div class='card shadow-lg mt-5 p-4 d-flex justify-content-center align-items-center'>
            <h2 class='h4 text-center'>Ainda não existem corretores cadastrados na base</h2>
          </div>";
        } ?>

    </div>

    <!-- JavaScript de Validação -->
    <script>
        document.getElementById("formCorretor").addEventListener("submit", function(event) {
            let nome = document.getElementById("nome").value.trim();
            let cpf = document.getElementById("cpf").value.replace(/\D/g, '');
            let creci = document.getElementById("creci").value.trim();

            if (nome.length < 2) {
                alert("O nome deve ter no mínimo 2 caracteres.");
                event.preventDefault();
                return;
            }

            if (cpf.length < 11) {
                alert("CPF inválido! Deve ter no mínimo 11 números.");
                event.preventDefault();
                return;
            }

            if (creci.length < 2) {
                alert("CRECI incompleto! Deve ter pelo menos 2 caracteres.");
                event.preventDefault();
                return;
            }
        });
    </script>

</body>

</html>