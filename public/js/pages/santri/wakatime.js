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