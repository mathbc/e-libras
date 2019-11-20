$(document).ready(function () {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#postagens section").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
})
