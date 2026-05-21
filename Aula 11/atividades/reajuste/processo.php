<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $preco = $_POST['preco'];
    $reajuste = $_POST['reajuste'];

    $novoPreco = $preco + ($preco * $reajuste / 100);

?>

    <div class="resultado">

        <h2>Resultado do Reajuste</h2>

        <p>
            O produto que custava 
            <strong>R$ <?= number_format($preco,2,",",".") ?></strong>
            com um reajuste de 
            <strong><?= number_format($reajuste,2,",",".") ?>%</strong>
            passará a custar 
            <strong>R$ <?= number_format($novoPreco,2,",",".") ?></strong>.
        </p>

    </div>

    <style>

        .resultado{
            margin-top: 25px;
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.3);
            border-left: 8px solid #4CAF50;
            max-width: 700px;
        }

        .resultado h2{
            color: #32208a;
            font-size: 35px;
            margin-bottom: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .resultado p{
            font-size: 24px;
            line-height: 1.6;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
        }

        .resultado strong{
            color: #000;
        }

        body {
            background-color: #32208a;
            justify-content: center;
            align-content: center;
            padding: 25;

        }

    </style>

<?php

}

?>