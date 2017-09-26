<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consulta de Actividades</title>
        <?php include_once 'header.php'; ?>
        <script type="text/javascript" src="js/forms/CreateList.js"></script>
    </head>
    <body onload="onLoadBody();">
        <?php include '../Views/menu.php'; ?>
        <div class="general-container">
            <form id='frmCreateList' name='frmConsultSync' enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="col s12 m8 l12 center-align">
                        <div class="row">                            
                            <h4 class="center-align">Crear Nueva Lista</h4>

                            <div class="input-field col m3 l3">

                            </div>

                            <div class="input-field col s12 m6 l6">
                                <input id="listName" type="text" class="validate">
                                <label for="listName">Nombre de la Lista</label>
                            </div>

                            <div class="input-field col m3 l3">

                            </div>

                        </div>

                        <div class="row">
                            <div class="col m3 l3">
                            </div>

                            <div class="input-field col s4 m3 l3">
                                <input id="addItem" type="text" class="validate" onkeydown="addItemF(event);">
                                <label for="addItem">Agregar Item</label>
                            </div>

                            <div class="col s4 m2 l2">
                                <select id="itemTipoList" class="browser-default">

                                </select>
                            </div>

                            <div class="col s4 m1 l1">
                                <a class="btn-floating btn-large waves-effect waves-light blue" onclick="addItemF(null);">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>

                            <div class="col m3 l3">
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="input-field col m3 l3">
                            </div>                            

                            <div class="col s12 m6 l6 center-align">                                                               
                                <table id="itemTable" style="display: none;">
                                    <thead>
                                        <tr>
                                            <th>No. Item</th>        
                                            <th>Descripción</th>  
                                            <th>Tipo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemList">
                                    </tbody>

                                </table>
                            </div>

                            <div class="input-field col m3 l3">
                            </div>

                        </div>

                        <div>
                            <a class="waves-effect waves-light btn" style="background: #3991FE;" onclick="saveInfo();">
                                <i class="material-icons left">folder</i>
                                Crear Lista
                            </a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </body>    
</html>