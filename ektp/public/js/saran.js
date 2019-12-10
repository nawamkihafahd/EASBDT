$(document).ready(function () {
    var saran = $('#id-saran').DataTable({
        order: [[ 0, "desc" ]],
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });

    var review = $('#id-review').DataTable({
        order: [[ 0, "desc" ]],
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
})