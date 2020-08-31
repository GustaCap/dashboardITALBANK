$(function(){

    // alert('todo bien');

    $('#tipocliente_id').on('change', onSelectClienteChange);

});

function onSelectClienteChange() {

    var tipocliente_id = $(this).val();

    // AJAX
    $.get('productos/5/estructuras', function(data) {
        alert(data);
        // console.log(data);

    });

}
