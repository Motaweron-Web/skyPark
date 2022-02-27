<script>
    var table = $('.customDataTable').DataTable({
        responsive: true,
        paging: false

        // "ordering": true,
        // columnDefs: [{
        //   'targets': [4, 5],
        //   'orderable': false
        // }, ]
    });
    accessWhenLoad()


    function accessWhenLoad() {
        var url = window.location.href;
        if (url.includes('search')) {
            getSearchValue(url)

            var slug = url.substring(url.indexOf("=") + 1);


            $('#searchValue').val(slug)
        }
    }

    $(document).on('click', '#searchButton', function () {
        var searchValue = $('#searchValue').val();
        if (searchValue.length == 0) {
            toastr.info('Please fill this input')
            return true;
        }

        var url = "{{route('groupAccess.index')}}?search=" + searchValue

        getSearchValue(url)

    })

    //////////////// البحث ///////////
    function getSearchValue(url) {
        $.ajax({
            type: 'GET',
            url: url,
            beforeSend: function () {
                window.history.pushState({path: url}, '', url);
                $('.spinner').show()
                table.clear().draw();
            },
            complete: function (data) {
                $('.spinner').hide()
            },
            success: function (data) {
                if (data.status === 200) {
                    var Rows = data.backArray;

                    $.each(Rows, function (key, val) {
                        table.row.add(data.backArray[key]).draw(false);
                    })

                } else if (data.status === 300) {
                    toastr.info('there is no data')
                }

            },

            error: function (data) {
                if (data.status === 500) {
                    toastr.error('Unexpected Error');
                } else if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                // toastr.error(value, key);
                            });
                        }
                    });
                }
            },//end error method
        });
    }

    $(document).on('click', '#checkAll', function (e) {
        e.stopImmediatePropagation();

        var array = [], firstBracelet, count = $('.braceletNumbers').length

        firstBracelet = $('.braceletNumbers').first().val();

        $('.spinner').show()


        var method = {
            count: count,
            firstBracelet: firstBracelet
        }


        $.post("{{route('capacity.getBracelets')}}", method, function (data) {
            if (data.length > 0) {
                $('.braceletNumbers').each(function (key, value) {
                    $(this).val(data[key])
                    var id = $(this).data('id')
                    setTimeout(submitRow(id), 100);
                })
            } else {
                toastr.warning('there is no bracelet free')
            }

        }).fail(function (data) {
            if (data.status == 404) {
                toastr.info('there is no bracelet found')
            }
        }).then(function (data) {
            if (data.length > 0)
                accessWhenLoad()
        })
        setTimeout(function () {
            $('.spinner').hide()
        }, 500)
    })


    $(document).on('click','.check',function () {
        var id = $(this).data('id')
        var braceletNumber = $('#braceletNumber' + id).val()

        $('.spinner').show()

        if (!braceletNumber.length) {
            toastr.warning('you should fill bracelet number')
        }else {
            submitRow(id)
            // if (submitRow(id)){
            // }
        }

        setTimeout(function () {
            accessWhenLoad()

        }, 400)
        setTimeout(function () {
            $('.spinner').hide()

        }, 500)


    })

    function submitRow(id) {


        var braceletNumber = $('#braceletNumber' + id).val()
        var birthDay = $('#birthDay' + id).val()
        var name = $('#name' + id).val()
        var gender = $('input[name=gender' + id + ']:checked').val();
        if (!braceletNumber.length) {
            return false;
        }

        var method = {
            bracelet_number: braceletNumber,
            birthday: birthDay,
            gender: gender,
            name: name,
            id: id,
            _method: "PUT",
        }

        var url = "{{route('groupAccess.update',":id")}}"

        url = url.replace(':id', id)
        $.post(url, method, function (data) {
            if (data) {
                return true;
            }
        }).fail(function (data) {
            if (data.status === 500) {
                toastr.error('there is an error');
            } else if (data.status === 422) {
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (key, value) {
                    if ($.isPlainObject(value)) {
                        $.each(value, function (key, value) {
                            toastr.error(value, key);
                        });

                    } else {
                    }
                });
            } else {
                toastr.error('there in an error');
            }
            return true;
        })
    }
</script>
