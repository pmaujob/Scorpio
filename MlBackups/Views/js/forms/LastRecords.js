function onLoadBody() {
    $(document).ready(function () {
        $('select').material_select();
    });
}

function findUsers() {

    var searchValue = document.getElementById('listTipo').value;
    
    if(searchValue == 0){
        alert("Debe seleccionar un orden.");
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: '../Views/dinamicForms/frmLastRecords.php',
        async: true,
        timeout: 0,
        data: {searchValue: searchValue},
        success: function (respuesta) {

            var userList = document.getElementById('userList');
            userList.style.display = "";
            userList.innerHTML = respuesta;

        }, error: function () {
            alert('Unexpected Error');
        }
    });


}

