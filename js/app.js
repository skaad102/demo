function comprobarEmail() {
    jQuery.ajax({
        url: "disponibilidad.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function (data) {
            $("#estadoemail").html(data);
        },
        error: function () {}
    });
}
