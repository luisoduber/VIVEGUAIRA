//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
$('input[type="file"]').on('change', function () {
    var ext = $(this).val().split('.').pop();

    alert(ext);
    if (ext != '') {
        if (ext == 'csv') {
            subirCsv();
            // GrdModUpCvig(); 
        }

        else {
            Swal.fire({
                title: 'Extensión no permitida: ' + ext,
                width: 500,
                padding: '2em',
                color: ' rgba(0,0,0,0.5)',
                background: ' rgba(255,255,255,0.9)',
            });
        }
    }
});
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
function GrdModUpCvig() {


    $.post('/UpLoad/GrdModUpCvig')
        .done(function (data) {
            var RsData = new Boolean(data);
            if (RsData) {
            }
            else if (!RsData) {
            }
        });

    return false;
}
