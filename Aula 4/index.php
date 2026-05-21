<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>COMPARAÇAO DE DADOS DE EMPRESAS DIFERETES</h1>
    <?php
$FuncionariosEmpresa1 = 4999; //variaveis da primeira empresa
$MaquinasEmpresa1 = 3520; //variaveis da primeira empresa
$FuncionariosEmpresa2 = 2000; //variaveis segunda empresa
$MaquinasEmpresa2 = 7002; //variaveis segunda empresa


$Diferença1 = $FuncionariosEmpresa1 - $MaquinasEmpresa1; //diferença de funcionarios e maquinas empresa 1

$Diferença2 =   $MaquinasEmpresa2 - $FuncionariosEmpresa2; //diferença de funcionarios e maquinas empresa 2

echo " Uma empresa possui " . $FuncionariosEmpresa1 . " de funcionarios e " . $MaquinasEmpresa1 . " de maquinas <br>";
echo " Nessa empresa tem uma diferença de " . $Diferença1 . " em relaçao de maquinas e funcionarios<br><br>";

echo " Ja a segunda empresa possui " .$FuncionariosEmpresa2 . " de funcionarios e " . $MaquinasEmpresa2 . " de maquinas <br>";
echo " Na segunda empresa a diferença é de " . $Diferença2 . " de maquinas em relaçao a funcionarios <br> <br>";

if (
    $FuncionariosEmpresa1 > $FuncionariosEmpresa2){
    echo "ha uma quantidade maior de funcionarios na empresa 1";
    }else{
        echo "ha uma quantidade maior de funcionarios na empresa 2";
    } //comparaçao entre quantidade de funcionarios empresa 1 e 2
?>
</body>
</html>

