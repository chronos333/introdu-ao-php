<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Análise da Empresa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            width: 300px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .resultado {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Resultado</h1>

    <div class="resultado">
        <?php
        //dados
        $funcionarios = 20;
        $tempo = 3;
        $setor = "tecnologia";

        //if / else
        if ($funcionarios <= 10) {
            echo "Empresa pequena<br>";
        } elseif ($funcionarios <= 50) {
            echo "Empresa média<br>";
        } else {
            echo "Empresa grande<br>";
        }

        //if / elseif (tempo)
        if ($tempo < 5) {
            echo "Empresa nova<br>";
        } else {
            echo "Empresa antiga<br>";
        }

        //switch
        switch ($setor) {
            case "tecnologia":
                echo "Área de tecnologia<br>";
                break;

            case "comercio":
                echo "Área de comércio<br>";
                break;

            default:
                echo "Setor não identificado<br>";
        }
        ?>
    </div>
</div>

</body>
</html>