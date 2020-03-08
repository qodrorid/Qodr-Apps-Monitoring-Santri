// submit form name="form-settings"
$('form[name="form-wakatime"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let id   = form.attr('wakatime')
    
    $.updated(`/wakatime/url/${id}`, data).then(() => {
        $('#form-wakatime').modal('hide')
        $('code#coding_activity').text(data.coding_activity)
        $('code#languages').text(data.languages)
        $('code#editors').text(data.editors)
        $('.btn-status').removeClass('btn-success')
                        .addClass('btn-danger')
                        .text('Status Not Active')
    })
})

/**
 * funtion activate wakatime url
 * @param id 
 * @param title 
 * @return @void
 */
function activate(id, title) {
    Swal.fire({
        title: `${title} this url ?`,
        text: "change wakatime url embed status",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1ABC9C',
        cancelButtonColor: '#E74C3C',
        confirmButtonText: title,
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                customClass: {
                    actions: 'swal2-icon-size',
                    popup: 'swal2-bg'
                },
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.get(`/wakatime/url/${id}/status`).then(response => {
                        Swal.fire("Success!", response.message, "success")
                        $.listdata('/wakatime/url/list')
                    }).catch(error => {
                        Swal.fire("Error!", error.statusText, "error")
                    })
                }
            })
        }
    })
}