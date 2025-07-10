<?php


$con = mysqli_connect('127.0.0.1:8889', 'root', 'root', 'acessoPortal');

//$con =     mysqli_connect('localhost', '', '');

$sql = 'select * from links where idlinks between 178 and 184';

$executar = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($executar)) {
 
?>

    <table>
        <tr>
            <td class="tituloCertidao"  colspan="2" ><?=$row['nomeDoLink']?></td>
        </tr>

        <tr style="border-color:white">
           
        <td><a class="texto" target="_blank" href="<?=$row['linkDescricao']?>">Descrição do Serviço</a></td>
        <td><a class="texto" target="_blank" href="<?=$row['linkAcesso']?>">Emissão</a></td>
           
        </tr>
    </table>


<?php


}



?>