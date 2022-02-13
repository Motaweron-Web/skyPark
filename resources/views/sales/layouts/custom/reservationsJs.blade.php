<script>
    $('.add').click(function () {
        $(this).prev().val(+$(this).prev().val() + 1);
    });
    $('.sub').click(function () {
        if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
    });

    var reservationTypes = JSON.parse('<?php echo $visitorTypes;?>')
    $.each(reservationTypes, function(index, value) {
        window["visitorType"+value.id] = new Object();
    })


    function calculate() {

    }


    var disVal = 0


    var warehouse_id = localStorage.getItem('warehouse_id') || 0;
    var new_product_array = [];
    var selected_product_array = [];
    var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;

    $(document).ready(function () {

        if (warehouse_id != 0) {
            $('select[name="warehouse_id"]').val(warehouse_id).change();
            getProductsWhenReload()
        }

        var array = localStorage.getItem('products');
        array = JSON.parse(array);
        if (array.length > 0) {
            selected_product_array = array

            $.ajax({
                url: "",
                type: 'POST',
                data: {products: array, warehouse_id: warehouse_id, _token: "{{csrf_token()}}"},
                success: function (data) {
                    $('#saleItems').html(data.html)
                    CalculateTotal()
                }, error: function (data) {

                    if (data.status === 500) {
                        toastr.error('هناك خطأ ما')
                    }


                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);

                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    toastr.error(value)
                                });

                            } else {

                            }
                        });
                    }
                }

            });

        }

    });
    var total = parseFloat($('#Total').html()) || 0;

    $(document).on('click', '#saveModal', function () {
        // alert('dd')
        if (selected_product_array.length != 0) {
            var id = $(this).data('id')
            $('#form-for-addOrDelete').html(loader);
            $('#SaleModal').modal('show')
            setTimeout(function () {
                total = parseFloat($('#Total').html())
                $.ajax({
                    url: "",
                    type: 'GET',
                    data: {products: selected_product_array, warehouse_id: warehouse_id, total: total},
                    success: function (data) {
                        if (data.status == 200) {
                            $('#form-for-addOrDelete').html(data.html)
                        }

                    }, error: function (data) {

                        if (data.status === 500) {
                            toastr.error('هناك خطأ ما')
                        }


                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);

                            $.each(errors, function (key, value) {
                                if ($.isPlainObject(value)) {
                                    $.each(value, function (key, value) {
                                        toastr.error(value)
                                    });

                                } else {

                                }
                            });
                        }
                    }

                });

                {{--$('#form-for-addOrDelete').load('{{route('sale-invoice.create')}}?products=' + selected_product_array + '&warehouse_id='+warehouse_id)--}}
            }, 500)
        } else {
            Swal.fire(
                'خطأ',
                'يجب أن تختار المنتجات أولاً',
                'error'
            )
        }
    });


    $('select[name="warehouse_id"]').on('change', function () {
        new_product_array = []

        if (warehouse_id != 0 && localStorage.getItem('warehouse_id') != $(this).val()) {
            clearData($(this).val())
        }


        warehouse_id = $(this).val();

        $.get('sale-invoice/getproduct/' + warehouse_id, function (data) {
            new_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            product_id = data[3];
            product_price = data[4];

            $.each(product_code, function (index) {
                new_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            });
            localStorage.setItem('warehouse_id', warehouse_id)
        });
    });

    function getProductsWhenReload() {
        new_product_array = []
        $.get('sale-invoice/getproduct/' + warehouse_id, function (data) {
            new_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            product_id = data[3];
            product_price = data[4];

            $.each(product_code, function (index) {
                new_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            });
            localStorage.setItem('warehouse_id', warehouse_id)
        });
    }

    $(document).on('click keyup', '.searchInput', function () {

        if (warehouse_id == 0) {
            Swal.fire(
                'خطأ',
                'يجب أن تختار المخزن أولاً',
                'error'
            )
        } else {

            var text = $(this).val()

            var loaderHtml = $('#loaderForSearch');

            loaderHtml.show()
            var resultHtml = $('#resultForSearch')
            resultHtml.html('')

            loaderHtml.html(loader)
            $(".searchResult").slideDown(100);


            if (text != '') {
                var filterd = new_product_array.filter(name => name.includes(text))

                if (filterd.length == 1) {
                    var barcode = filterd[0].split(" ");

                    searchWithData(barcode[0])

                    setTimeout(function () {

                        $(".searchResult").slideUp(100);

                        loaderHtml.hide()
                        resultHtml.show()
                    }, 750)
                } else if (filterd.length != 0) {
                    setTimeout(function () {
                        resultHtml.html('')

                        $.each(filterd, function (index) {
                            var barcode = filterd[index].split(" ");
                            resultHtml.append('<li onclick="searchWithData(' + barcode[0] + ')"><a class="pointer">' + filterd[index] + '</a></li>')
                        });
                        loaderHtml.hide()
                        resultHtml.show()
                    }, 750)
                } else if (filterd == 0) {
                    setTimeout(function () {

                        $(".searchResult").slideUp(100);

                        loaderHtml.hide()
                        resultHtml.show()
                    }, 750)
                }


            } else {
                setTimeout(function () {
                    resultHtml.html('')

                    $.each(new_product_array, function (index) {
                        var barcode = new_product_array[index].split(" ");

                        resultHtml.append('<li class="pointer"  onclick="searchWithData(' + barcode[0] + ')"><a class="pointer" >' + new_product_array[index] + '</a></li>')
                    });
                    if (resultHtml.html() == '') {
                        $(".searchResult").slideUp(100);
                    }
                    loaderHtml.hide()
                    resultHtml.show()
                }, 750)
            }


        }


    });
    var mouse_is_inside = false;

    $(document).ready(function () {
        $('.searchBox').hover(function () {
            mouse_is_inside = true;
        }, function () {
            mouse_is_inside = false;
        });

        $("body").mouseup(function () {
            if (!mouse_is_inside) $(".searchResult").slideUp(100);
        });
    });


    // $(document).on('click', '.pointer', function () {
    //     var barcode = $(this).data('barcode')
    //     console.log(barcode)
    //     // $('.searchInput').val(barcode)
    //
    //     searchWithData(barcode)
    // });

    function searchWithData(barcode) {
        $.ajax({
            url: "",
            type: 'POST',
            data: {barcode: barcode, warehouse_id: warehouse_id, _token: "{{csrf_token()}}"},
            success: function (data) {


                if (data == 405) {
                    alert('نأسف . لا يوجد كمية فى هذا المخزن')
                }
                if (data.status == 200) {

                    if (!selected_product_array.find(({id}) => id === data.id)) {
                        console.log('yes')
                        $('#saleItems').append(data.html)
                        var productDetails = {
                            title: data.title,
                            id: data.id,
                            product_price: data.product_price,
                            qty: 1,
                        }
                        selected_product_array.push(productDetails)
                    } else {

                        for (var i in selected_product_array) {
                            if (selected_product_array[i].id == data.id) {
                                selected_product_array[i].qty += 1;
                                $('#Qty' + data.id).val(selected_product_array[i].qty)

                                break; //Stop this loop, we found it!
                            }
                        }

                    }
                    localStorage.setItem('products', JSON.stringify(selected_product_array))
                    $('.searchInput').val('')
                    CalculateTotal()
                }


            }, error: function (data) {

                if (data.status === 500) {
                    toastr.error('هناك خطأ ما')
                }


                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);

                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value)
                            });

                        } else {

                        }
                    });
                }
            }

        });

    }

    // Input Plus & Minus Number JS
    $(document).on('click', '.minus-btn', function () {
        var id = $(this).data('id')

        var inputQty = $('#Qty' + id)

        var qty = parseInt(inputQty.val());

        if (qty > 1) {

            qty -= 1;

            inputQty.val(qty)


            for (var i in selected_product_array) {
                if (selected_product_array[i].id == id) {
                    selected_product_array[i].qty -= 1;
                    $('#Qty' + id).val(selected_product_array[i].qty)
                    break; //Stop this loop, we found it!
                }
            }
            localStorage.setItem('products', JSON.stringify(selected_product_array))


            CalculateTotal()

        } else {

            $('#Row' + id).remove()

            for (var i in selected_product_array) {
                if (selected_product_array[i].id == id) {
                    selected_product_array.splice(i, 1);
                    break; //Stop this loop, we found it!
                }
            }
            localStorage.setItem('products', JSON.stringify(selected_product_array))
            CalculateTotal()

        }

    });

    // Input Plus & Minus Number JS
    $(document).on('click', '.plus-btn', function () {
        var id = $(this).data('id')

        var inputQty = $('#Qty' + id)

        var qty = parseInt(inputQty.val());

        qty += 1;

        inputQty.val(qty)

        for (var i in selected_product_array) {
            if (selected_product_array[i].id == id) {
                selected_product_array[i].qty += 1;
                $('#Qty' + id).val(selected_product_array[i].qty)
                break; //Stop this loop, we found it!
            }
        }
        localStorage.setItem('products', JSON.stringify(selected_product_array))


        CalculateTotal()

    });

    function CalculateTotal() {
        var totalPrice = 0
        $('.allPrice').each(function (i) {
            totalPrice += parseFloat($(this).data('price')) * parseInt($(this).val())
        })
        $('#Total').html(totalPrice)
    }

    function clearData(warehouse_id) {
        localStorage.setItem('products',[])
        if (warehouse_id != 0) {
            localStorage.setItem('warehouse_id', warehouse_id)
        }
        if (localStorage.getItem('warehouse_id') != null || localStorage.getItem('warehouse_id') != ""){
            location.reload()
        }
    }

    $(document).on('click', '.addClintBtn', function () {
        $('.addClintSection').css('display','flex')
    });
    $(document).on('change', '#coupon_id', function () {
        var id = $(this).val()
        var value = 0;
        var tax = parseFloat($('#tax').val()) || 0
        var type;
        $('.couponValue').each(function () {
            if ($(this).attr('value') == id) {
                value = $(this).attr('data-value')
                type = $(this).attr('data-type')
            }
        })

        if (type == 'pre') {
            disVal = (value / 100) * (total)
        } else {
            disVal = value;
        }

        $('#discount_value').val((disVal).toFixed(2))
        $('#DiscValue').html((disVal).toFixed(2) + " {{auth()->user()->currency}}")

    });
    $(document).on('keyup', '#paid_price', function () {
        var totalWithTax =  parseFloat($('#tax').val()||0) + parseFloat(total);
        $('#total_price').val(totalWithTax)

        totalWithTax -= parseFloat(disVal)


        if (parseFloat($(this).val()) <= totalWithTax ){
            var paid = totalWithTax - parseFloat($(this).val())||0

            $('#remainingPrice').html((paid).toFixed(2) + " {{auth()->user()->currency}}")
            $('#remaining_price').val((paid).toFixed(2))
        }else {

            if ($(this).val()!=0){
                $(this).val(totalWithTax)
            }

        }


    });



</script>
