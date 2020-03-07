window._ = require('lodash')
// State Query
var stateQuery = {}

// locading swal custom css
var swalCustomClass = {
    actions: 'swal2-icon-size',
    popup: 'swal2-bg'
}

// serialize objec jquery
$.fn.serializeObject = function() {
    var obj = {}
    var arr = this.serializeArray()
    arr.forEach(function(item) {
        if (obj[item.name] === undefined) { // New
            obj[item.name] = item.value || ''
        } else {                            // Existing
            if (!obj[item.name].push) {
                obj[item.name] = [obj[item.name]]
            }
            obj[item.name].push(item.value || '')
        }
    })
    return obj
}

// Get Params URL
$.getParamsUrl = function(url) {
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
    var obj = {};
  
    if (queryString) {
      queryString = queryString.split('#')[0];
      var arr = queryString.split('&');
  
      for (var i = 0; i < arr.length; i++) {
        var a = arr[i].split('=');
        var paramName = a[0];
        var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];
  
        paramName = paramName.toLowerCase();
        if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();
  
        if (paramName.match(/\[(\d+)?\]$/)) {
  
          var key = paramName.replace(/\[(\d+)?\]/, '');
          if (!obj[key]) obj[key] = [];
  
          if (paramName.match(/\[\d+\]$/)) {
            var index = /\[(\d+)\]/.exec(paramName)[1];
            obj[key][index] = paramValue;
          } else {
            obj[key].push(paramValue);
          }
        } else {
          if (!obj[paramName]) {
            obj[paramName] = paramValue;
          } else if (obj[paramName] && typeof obj[paramName] === 'string'){
            obj[paramName] = [obj[paramName]];
            obj[paramName].push(paramValue);
          } else {
            obj[paramName].push(paramValue);
          }
        }
      }
    }
  
    return obj;
  }

// token CSRF
const headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

// multipart config ajax
const multipartConfig = {
    processData: false,
    contentType: false,
    cache: false
}

// created data
$.created = function(url, data, alert = true, multipart = false) {
    let config = multipart ? multipartConfig : {}
    return new Promise((resolve, reject) => {
        Swal.fire({
            customClass: swalCustomClass,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                $('.modal.show').modal('hide')
                Swal.showLoading()
                $.ajax({
                    url: urlbase(url),
                    headers,
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    ...config,
                    success: (response) => {
                        if (alert) Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            text: response.message,
                            allowOutsideClick: false
                        })
                        resolve(response)
                    },
                    error: (error) => {
                        if (error.responseJSON) {
                            if (alert) Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: error.responseJSON.message,
                                allowOutsideClick: false
                            })
                            reject(error.responseJSON)
                        } else {
                            if (alert) Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: error.statusText,
                                allowOutsideClick: false
                            })
                            reject(error)
                        }
                    }
                })
            }
        })
    })
}

// created data
$.updated = function(url, data, alert = true, multipart = false) {
    let config = multipart ? multipartConfig : {}
    return new Promise((resolve, reject) => {
        Swal.fire({
            customClass: swalCustomClass,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                $('.modal.show').modal('hide')
                Swal.showLoading()
                $.ajax({
                    url: urlbase(url),
                    headers,
                    method: 'PUT',
                    data: data,
                    dataType: 'json',
                    ...config,
                    success: (response) => {
                        if (alert) Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            text: response.message,
                            allowOutsideClick: false
                        })
                        resolve(response)
                    },
                    error: (error) => {
                        if (error.responseJSON) {
                            if (alert) Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: error.responseJSON.message,
                                allowOutsideClick: false
                            })
                            reject(error.responseJSON)
                        } else {
                            if (alert) Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: error.statusText,
                                allowOutsideClick: false
                            })
                            reject(error)
                        }
                    }
                })
            }
        })
    })
}

// created data
$.deleted = function(url) {
    return new Promise((resolve, reject) => {
        Swal.fire({
            customClass: swalCustomClass,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                $('.modal.show').modal('hide')
                Swal.showLoading()
                $.ajax({
                    url: urlbase(url),
                    headers,
                    method: 'DELETE',
                    dataType: 'json',
                    success: (response) => {
                        Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            text: response.message,
                            allowOutsideClick: false
                        })
                        resolve(response)
                    },
                    error: (error) => {
                        if (error.responseJSON) {
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: error.responseJSON.message,
                                allowOutsideClick: false
                            })
                            reject(error.responseJSON)
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: error.statusText,
                                allowOutsideClick: false
                            })
                            reject(error)
                        }
                    }
                })
            }
        })
    })
}

// find data
$.finddata = function(url) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: urlbase(url),
            headers,
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                resolve(response)
            },
            error: (error) => {
                reject(error)
            }
        })
    })
}

// created data
$.listdata = function(url, config, listid = 'listitem') {
    if (typeof config !== 'undefined') {
        var showitem = config.showitem || $('select[name="showitem"]').val()
        var keyword  = config.keyword || $('input[name="keyword"]').val()
        var page     = config.page || $('.page-item.active .page-link').text()
    } else {
        var showitem = $('select[name="showitem"]').val()
        var keyword   = $('input[name="keyword"]').val()
        var page     = $('.page-item.active .page-link').text()
    }
    
    var data = {
        ...config,
        showitem,
        keyword,
        page
    }

    $.ajax({
        url: urlbase(url),
        method: 'GET',
        data,
        dataType: 'html',
        success: (response) => {
            $('#' + listid).html(response)
            window.stateQuery = config
            linkpaginate()
        },
        error: (error) => {
            Swal.fire({
                type: 'error',
                title: 'Error!',
                text: error.statusText,
                allowOutsideClick: false
            })
        }
    })
}

// change showitem
$('select[name="showitem"]').change(function() {
    $.listdata($(this).data('url'), window.stateQuery)
})

// button search paginate
$('.btn-paginate-search').click(function() {
    $.listdata($(this).data('url'), window.stateQuery)
})

// enter form search paginate
$('input[name="keyword"]').keypress(function (e) {
    if (e.which == 13) {
        $.listdata($(this).data('url'), window.stateQuery)
        return false
    }
})

// link paginate
function linkpaginate() {
    $('[data-paginate-link]').click(function(e) {
        e.preventDefault()
        let href      = $(this).attr('href').replace(urlbase(), '')
        let splitHref = href.split('?')
        let url       = splitHref[0]
        let config    = $.getParamsUrl(href)
        
        $.listdata(url, config)
    })
}
linkpaginate()