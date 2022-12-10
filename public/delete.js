$(document).ready(function() {
    $('#btn btn-primary').click(function (e) {
        e.preventDefault();
        itemId = $(this).attr('data-id');
        $.ajax({
            url: frm.attr('DELETE'),
            data: { 'entityId': itemId },
            method: 'POST',
            success: function (_data, reponse) {
                if (reponse == 'good') {
                    alert("ok");
                    var row = document.getElementById(itemId);
                    row.parentNode.removeChild(row);
                }
            },
            error: function () {
                alert("no");
            },
        });
    });
});