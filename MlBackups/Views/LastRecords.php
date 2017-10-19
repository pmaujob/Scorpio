<?php
@session_start();

$pRoot = $_SESSION['pRoot'];
$pRootHtml = $_SESSION['pRootHtml'];
?>

<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <title>Últimos Registros</title>
        <?php include_once $pRoot . '/Admin/Views/header.php'; ?>
        <?php include_once $pRoot . '/MlBackups/Views/headerp.php'; ?>
        <script type="text/javascript" src="js/forms/LastRecords.js"></script>
    </head>
    <body onload="onLoadBody();">
        <?php include $pRoot . '/Admin/Views/menu.php'; ?>
        <div class="general-container">
            <form id='frmConsultSync' name='frmLastRecords' enctype="multipart/form-data">

                <div class="row">
                    <div class="col m2 l2">

                    </div>
                    <div class="col s12 m8 l8 center-align">
                        <span>Realice la búsqueda por nombre o área.</span>                        
                    </div>
                    <div class="col m2 l2">

                    </div>
                </div>

                <div class="row">
                    <div class="col m4 l4">

                    </div>
                    <div class="input-field col s9 m4 l4">
                        <select id="listTipo">
                            <option value="0" disabled selected>Seleccione una Opción</option>
                            <option value="a">Por Área</option>
                            <option value="d">Por Fecha</option>
                            <option value="s">Por Tamaño</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col s3 m3 l3">
                            <a class="waves-effect waves-light" href="#!" onclick="openModal();">
                                <img id="iconSearch" src="<?php echo $pRootHtml . "/Publics/images/view.png"; ?>" style="width: 40%; height: 40%;" onclick="findUsers();">
                            </a>
                        </div>
                    </div>

                    <div class="col m1 l1">

                    </div>
                </div>

                <div class="row">
                    <div class="col m2 l2">

                    </div>

                    <div class="col s12 m8 l8">
                        <ul id="userList" class="collection" style="display: none;">

                        </ul>
                    </div>


                    <div class="col m2 l2">

                    </div>
                </div>

            </form>
        </div>
    </body>
</html>
