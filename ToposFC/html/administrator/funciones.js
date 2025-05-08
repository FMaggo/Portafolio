function modificar(arreglo){
    cadena = arreglo.split(',');
    alert(arreglo);
    $("#id_team_").val(cadena[0]);
    document.getElementById("id_eli").textContent = 'ID: ' + cadena[0];
    $("#team_name_").val(cadena[2]);
    $("#pj_").val(cadena[3]);
    $("#g_").val(cadena[4]);
    $("#e_").val(cadena[5]);
    $("#p_").val(cadena[6]);
    $("#gf_").val(cadena[7]);
    $("#gc_").val(cadena[8]);
    $("#dg_").val(cadena[9]);
    $("#pts_").val(cadena[10]);
}

$('#modificar_adm').click(function (){
    var recolec = $('#for_adm').serialize();
    alert(recolec);
    $.ajax({
        url:'../administrator/adm_mod.php   ',
        type: 'POST',
        data: recolec,

        success:function(response){
            // Buscar la tabla dentro de la respuesta AJAX y actualizar el contenido de #adm
            $('#adm').html($(response).find('#adm').html());
            $('#modificar').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').hide();
        }
    })
});