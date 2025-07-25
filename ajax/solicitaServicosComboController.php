<?php



//combo Categorias da da pagina Habilitacao
if (isset($_POST['containner']) && $_POST['containner'] == 'comboServicosCategoria') {
    include_once '../classes/Categoria.php';

    $objCategoria = new Categoria();

    $dados =    $objCategoria->trazerCategorias();

    echo  '<option    >     </option>';

    foreach ($dados as $key => $value) {
        echo '<option     value=' . $value['idCategoria'] . '  >' .  $value['descricaoCategoria'] . '</option>';
    }
}





//combo serviços da pagina index (criado para trazer o link)
if (isset($_POST['containner']) && $_POST['containner'] == 'comboServicos') {
    include_once '../classes/servicos.php';

    $objservico = new Servicos();

    $dados = $objservico->servicosHabilitados();



    echo  '<option    >     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['descricaoCarta'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option    codigo='    . $value['idlinkCartaServico'] . '     value=' . $value['linkCarta'] . '  >' . $descricao . '</option>';
    }
}


//combo serviços (criado para trazer o id de cada serviço)
if (isset($_POST['containner']) && $_POST['containner'] == 'comboServicosDocumentos') {
    include_once '../classes/servicos.php';

    $objservico = new Servicos();

    $dados = $objservico->trazerServicos();



    echo  '<option>     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['descricaoCarta'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option value=' . $value['idlinkCartaServico'] . '>' . $descricao . '</option>';
    }
}


if (isset($_POST['containner']) && $_POST['containner'] == 'comboDocumentos') {
    include_once '../classes/Documentos.php';

    $objservico = new Documentos();

    $dados = $objservico->trazerDocumentos();



    echo  '<option    >     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['descricaoDoc'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option value=' . $value['idDoc'] . '  >' . $descricao . '</option>';
    }
}


if (isset($_POST['containner']) && $_POST['containner'] == 'comboTipoInscricao') {
    include_once '../classes/Documentos.php';

    $objservico = new Documentos();

    $dados = $objservico->trazerDocumentos(' where status = 9 ');



    echo  '<option    >     </option>';


    foreach ($dados as $key => $value) {

        $descricao = $value['descricaoDoc'];
        if (strlen($descricao) > 200) {

            $descricao = substr($descricao, 0, 200) . '...';
        }


        echo '<option value=' . $value['idDoc'] . '  >' . $descricao . '</option>';
    }
}
