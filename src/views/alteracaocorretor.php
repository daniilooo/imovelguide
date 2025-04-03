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
        <h1 class="text-center mb-4">Alteração do cadastro de Corretor</h1>

        <!-- Formulário de Cadastro -->
        <div class="card shadow-lg">
            <div class="card-body">

                <form id="formCorretor" action="/imovelguide/corretores/alterarCorretor" method="POST">

                    <input type="hidden" name="idCorretor" value="<?= $corretor->getIdCorretor() ?>">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input class="form-control" type="text" id="nome" name="nome" autocomplete="off" value="<?= $corretor->getNomeCorretor() ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input class="form-control" type="text" id="cpf" name="cpf" maxlength="14" autocomplete="off" value="<?= $corretor->getCpf() ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="creci" class="form-label">CRECI</label>
                        <input class="form-control" type="text" id="creci" name="creci" autocomplete="off" value="<?= $corretor->getCreci() ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Alterar o cadastro</button>
                </form>
            </div>
        </div>
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