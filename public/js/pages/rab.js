// token CSRF
const headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

// add with keydown
document.addEventListener('keyup', function(e) {
    if (e.ctrlKey && e.key == ' ') {
        let row = $('#new-row > table > tbody').html()
        let rab = $('select[name="rab_id"]').val()

        if (typeof $('#listitem > tr.add-row').html() === 'undefined' && rab !== '' && rab !== null && typeof rab !== 'undefined')
        $('tbody#listitem').append(row)
        
        $('#listitem #price').autoNumeric({
            anDefault: 0,
            vMin: 0,
            aSign: 'Rp. ',
            aSep: '.',
            aDec: ',',
            mDec: 0
        })

        $('#listitem #total').autoNumeric({
            anDefault: 0,
            vMin: 0,
            aSign: 'Rp. ',
            aSep: '.',
            aDec: ',',
            mDec: 0
        })
    }

    if (e.ctrlKey && (e.which == 13 || e.keyCode == 13)) {
        submitRow()
    }
})

function submitRow() {
    if (!validity()) return false
    let rab_id = $('select[name="rab_id"]').val()
    let newRow = $('#listitem > tr.add-row')
    let data = {
        rab_id,
        for: newRow.find('#for').val(),
        qty: newRow.find('#qty').val(),
        price: newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        total: newRow.find('#total').val().replace('Rp. ', '').replace(/\./g, '')
    }

    newRow.addClass('table-active')
    newRow.find('#for').prop('disabled', true)
    newRow.find('#qty').prop('disabled', true)
    newRow.find('#price').prop('disabled', true)
    newRow.find('.btn-remove').prop('disabled', true)
    newRow.find('.btn-submit').prop('disabled', true)
    
    $.ajax({
        url: urlbase('/rab'),
        headers,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: (response) => {
            if (response.status) {
                $.listdata('/rab') 
            }
        },
        error: (error) => {
            if (error.responseJSON) {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error.responseJSON.message,
                    allowOutsideClick: false
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error.statusText,
                    allowOutsideClick: false
                })
            }
        }
    })
}

function removeRow(that) {
    $(that).closest('.add-row').remove()
}

function countTotal() {
    let newRow = $('#listitem > tr.add-row')
    let qty    = parseInt(newRow.find('#qty').val().replace(/\./g, ''))
    let price  = parseInt(newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''))
    
    let total  = (isNaN(qty) || isNaN(price) || parseInt(qty * price) < 0) ? 0 : parseInt(qty * price)
    $('#listitem #total').autoNumeric('set', total)
}

function validity() {
    let newRow = $('#listitem > tr.add-row')
    let data = {
        for: newRow.find('#for').val(),
        qty: newRow.find('#qty').val(),
        price: newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        total: newRow.find('#total').val().replace('Rp. ', '').replace(/\./g, '')
    }

    for (const key in data) {
        if (data[key] === '' || data[key] === '0') {
            $('#' + key).tooltip('show').focus()
            return false
        } else {
            $('#' + key).tooltip('hide')
        }
    }

    return true
}