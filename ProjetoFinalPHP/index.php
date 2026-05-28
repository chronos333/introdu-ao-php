<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogixEye</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="./img/logo.png">
</head>
<body>
    <h1>Seja bem vindo ao sistema de monitoramento</h1>
   <form class="row g-3"action="pagina_inicial.php"method="POST">
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">
                Nome do funcionario
            </label>
            <input type="text" class="form-control" id="validationDefault01"name="nome" required>
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Credencial de acesso</label>
            <input type="number" class="form-control" id="validationDefault02" name="credencial" required>
        </div>
        <div class="col-md-4">
            <label> Senha</label>
            <div class="input-group">
                <input type="password" class="form-control" id="validationDefaultUsername" name="senha"required>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Entrar no Sistema</button>
        </div>
    </form>
</body>
</html>