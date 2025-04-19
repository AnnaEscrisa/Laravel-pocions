//article qr
$(document).ready(function () {
    let checks = $("input[type=checkbox]")
    checks.on("change", changeArticleQr);
});

function changeArticleQr() {
   
    const formData = new FormData(document.getElementById('codeForm'));
    $.ajax({
        url: 'qr?article=true',
        type: 'POST',
        data: Object.fromEntries(formData),
        success: function (response) {
            console.log(response)
            $("#modal-qr").html(response);
        },
    });
}