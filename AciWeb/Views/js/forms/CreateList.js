var itemArray = new Array();
var idCount = 0;

function onLoadBody() {

    jQuery.ajax({
        type: 'POST',
        url: '../Models/MListaTipo.php',
        async: true,
        timeout: 0,
        success: function (respuesta) {

            var tipoArray = JSON.parse(respuesta);
            var itemTipoList = document.getElementById('tipoList');

            for (var i = 0; i < tipoArray.length; i++) {

                var tipoObject = tipoArray[i];
                var opt = document.createElement('option');
                opt.value = tipoObject.id
                opt.text = tipoObject.des;

                itemTipoList.appendChild(opt);

            }

        }, error: function () {
            alert('Unexpected Error');
        }
    });

}

function addItemF(e) {

    if (e != null && e.keyCode !== 13) {
        return;
    }

    var itemList = document.getElementById('itemList');
    var addItem = document.getElementById('addItem');

    if (addItem.value.trim().length == 0) {
        alert('Debe ingresar un valor.');
        return;
    }

    if (itemArray.length == 0) {
        document.getElementById('itemTable').style.display = "";
    }

    var item = document.createElement('tr');
    item.id = "itemRow" + idCount;
    item.innerHTML = '<td>' + (itemArray.length + 1)
            + '</td><td>' + addItem.value
            + '</td><td><a target="_blank" style="text-decoration: underline; cursor: pointer;" onclick="removeItem(\'' + idCount + '\');">Quitar</a></td>';
    itemList.appendChild(item);

    var itemRow = new Array();
    itemRow.push(idCount);
    itemRow.push(addItem.value);

    itemArray.push(itemRow);
    addItem.value = "";
    addItem.focus();
    idCount++;

}

function removeItem(itemPos) {

    $("#itemRow" + itemPos).remove();

    for (var i = 0; i < itemArray.length; i++) {
        var row = itemArray[i];

        if (itemPos == row[0]) {
            itemArray.splice(i, 1);
            break;
        }
    }

    if (itemArray.length == 0) {
        document.getElementById('itemTable').style.display = "none";
    } else {

        var itemList = document.getElementById('itemList');
        var trs = itemList.getElementsByTagName("tr");

        for (var i = 0; i < trs.length; i++) {
            var tds = trs[i].getElementsByTagName("td");
            tds[0].innerHTML = i + 1;
        }

    }

}

function saveInfo() {

    var listName = document.getElementById('listName');
    var listTipo = document.getElementById('tipoList');

    if (listName.value.trim().length == 0) {
        alert('Debe ingresar el nombre para nueva lista.');
        return;
    }

    if (itemArray.length == 0) {
        alert('Debe agregar al menos 1 item a la lista.');
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: '../Controllers/SaveListInfo.php',
        async: true,
        timeout: 0,
        data: {listName: listName.value, listTipo: listTipo.value, itemArray: itemArray},
        success: function (respuesta) {

            console.log(respuesta);

            if (respuesta == 1) {
                alert("La lista se guardó satisfactoriamente.");

                document.getElementById('itemList').innerHTML = "";
                document.getElementById('listName').value = "";
                document.getElementById('itemTable').style.display = "none";

                itemArray = new Array();
                idCount = 0;

            } else {
                alert("No se pudo guardar la lista, vuelva a intentarlo.");
            }

        }, error: function () {
            alert('Unexpected Error');
        }
    });

}

