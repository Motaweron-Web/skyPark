<script>
    var amountCash = $("#amount"),
        total      = $('#totalPrice');
    // Check Capacity And Get Price Of Visitor Models
    $(document).on('click', '#firstNext', function () {
        var myDate = $('#date').val(),
            myDuration = $('#duration').val(),
            shift = $('#choices-shift').val();
        if(myDuration.length > 0) {
            $.ajax({
                type: 'GET',
                url: "{{route('calcCapacity')}}",
                data: {
                    'visit_date': myDate,
                    'hours_count': myDuration,
                    'shift_id': shift,
                },
                success: function (data) {
                    if (data.status === true) {
                        $('#dateOfTicket').text(myDate);
                        $('#hourOfTicket').text(myDuration + " h");
                        $('#shiftOfTicket').text($('#choices-shift').text());
                        for (var i = 0; i < data.shift_prices.length; i++) {
                            $('#price' + data.shift_prices[i].visitor_type_id).val(data.shift_prices[i].price)
                        }
                        localStorage.setItem('available',data.available)
                        toastr.success(data.available + " places are still available");
                    } else {
                        toastr.error(data.day + " is fully booked");
                        $("button[title='visitors']").removeClass('js-active');
                        $("#visitorsTab").removeClass('js-active');
                        $("button[title='ticket']").addClass('js-active');
                        $("#ticketTab").addClass('js-active');
                    }
                },
                error: function (data) {
                    if (data.status === 500) {
                        toastr.error('Sorry there is an error');
                    } else if (data.status === 422) {
                        $("button[title='ticket']").addClass('js-active');
                        $("#ticketTab").addClass('js-active');
                        $("button[title='visitors']").removeClass('js-active');
                        $("#visitorsTab").removeClass('js-active');
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    toastr.error(value, key);
                                });
                            }
                        });
                    }
                },//end error method
            });
        }else{
            $("button[title='visitors']").removeClass('js-active');
            $("#visitorsTab").removeClass('js-active');
            $("button[title='ticket']").addClass('js-active');
            $("#ticketTab").addClass('js-active');
            $('#durationError').text('Reservation Duration is required')
        }
    });

    var table;
    table = $('.firstTable').DataTable({
        responsive: true,
    });
    var count = 1;
    table.clear();

    function appendRow(type_id, type, price) {
        if(localStorage.getItem('available') > table.rows().count()) {
            var row = table.row.add([
                `<span data-type_id="${type_id}" id="visitor_type[]">${type}</span>`,
                `<span data-price="${price}" id="visitor_price[]">${price}</span>`,
                '<input type="text" class="form-control" placeholder="Name" name="visitor_name[]">',
                '<input type="date" class="form-control" name="visitor_birthday[]" id="visitor_birthday[]">',
                `<div class="choose">
                   <div class="genderOption">
                     <input type="radio" class="btn-check" name="gender${count}" id="option1${count}" value="male">
                     <label class=" mb-0 btn btn-outline" for="option1${count}"><span><i class="fas fa-male"></i></span></label>
                   </div>
                   <div class="genderOption" style="display: none">
                     <input type="radio" class="btn-check" name="gender${count}" id="option1${count}" value="" checked>
                     <label class=" mb-0 btn btn-outline" for="option1${count}"></label>
                   </div>
                 <div class="genderOption">
                    <input type="radio" class="btn-check" name="gender${count}" id="option2${count}" value="female">
                    <label class=" mb-0 btn btn-outline" for="option2${count}"><span><i class="fas fa-female"></i> </span></label>
                 </div>
                 </div>`,
                `<span class="controlIcons">
                     <span class="icon Delete" data-bs-toggle="tooltip" title="Delete" data-model_id="${type_id}"> <i
                      class="far fa-trash-alt"></i> </span>
                </span>`
            ]).draw().node();
            count++;
            $(row).addClass(type);
            getCount(type, type_id)
        }else{
            toastr.error("The park is full")
        }
    }

    function getCount(className, type_id) {
        $('.visitorType' + type_id).find('.count').text(table.rows('[class*=' + className + ']').count());
    }

    $(document).on('click', '.visitorType', function () {
        var type = $(this).find('.visitor').text();
        var visitor_type_id = $(this).find('#visitor_type_id').val();
        appendRow(visitor_type_id, type, $(this).find('input').val())
    });

    $('.firstTable').on('click', 'tbody tr .Delete', function () {
        table.row($(this).parent().parent()).remove().draw();
        getCount($(this).parent().parent().parent().attr('class').replace('odd ', '').replace('even ', '').replace(' odd', '').replace(' even', ''), $(this).attr("data-model_id"))
    });


    ////////////////////////////////////////////
    // choice Js
    ////////////////////////////////////////////
    if (document.getElementById('choices-shift')) {
        var element = document.getElementById('choices-shift');
        const options = new Choices(element, {
            searchEnabled: false
        });
    }
    if (document.getElementById('choices-category')) {
        var element = document.getElementById('choices-category');
        const options = new Choices(element, {
            searchEnabled: false
        });
    }
    if (document.getElementById('choices-discount')) {
        var element = document.getElementById('choices-discount');
        const options = new Choices(element, {
            searchEnabled: false
        });
    }



    // Show categories
    var categories = JSON.parse('<?php echo json_encode($categories) ?>');
    $(document).on('change', '#choices-category', function () {
        var id = $(this).val();
        var category = categories.filter(oneObject => oneObject.id == id)
        if (category.length > 0) {
            var products = category[0].products

            $('#choices-product').html('<option value="" disabled>Choose The Product</option>')

            $.each(products, function (index) {
                $('#choices-product').append('<option value="' + products[index].id + '" data-price="' + products[index].price + '"> ' + products[index].title + '</option>')
            })
        }
    })

    var myNewTable = $('#myNewTable');
    var myTable;
    myTable = myNewTable.DataTable({
        responsive: true,
    });
    myTable.clear();
    $('#addBtn').click(function () {
        var product_select = $('#choices-product'),
            product = product_select.find(":selected").text(),
            product_id = product_select.find(":selected").val(),
            price = product_select.find(":selected").attr('data-price'),
            category_id = $('#choices-category').find(":selected").val();
        if (myTable.rows('[class*=productrow' + product_id + ']').count() === 0) {
            if (product_id === '') {
                toastr.error("Please Choose The Product ");
            } else {
                var row = myTable.row.add([
                    `<span id="spanProductId" data-product_id="${product_id}">${product}</span>`,
                    `<span class="price" id="price${product_id}">${price}</span>`,
                    `<div class="countInput">
                        <button type="button" class=" sub" id="subBtn">-</button>
                        <input type="number"  disabled id="qtyVal${product_id}" class="qtyVal" value="1" min="1"/>
                        <button type="button" class=" add plusBtn" id="plusBtn">+</button>
                    </div>`,
                    `<span class="productTotalPrice" id="productTotalPrice${product_id}">${price}</span>`,
                    `
                              <span class="controlIcons">
                                <span class="icon Delete" data-bs-toggle="tooltip" title="Delete"> <i
                                    class="far fa-trash-alt"></i> </span>
                              </span>
                `
                ]).draw().node();
                $(row).addClass('productrow' + product_id);
            }
        } else {
            var oldQty = parseInt($('#qtyVal'+product_id).val()||0)
            $('#qtyVal'+product_id).val(oldQty+ 1)
            var qty =  $('#qtyVal'+product_id).val();
            $('#productTotalPrice'+product_id).text(price*qty)
        }
    });
    myNewTable.on('click', 'tbody tr .Delete', function () {
        myTable.row($(this).parent().parent()).remove().draw();
    });
    myNewTable.on('click', 'tbody tr .plusBtn', function () {
        var value = $(this).closest('tr').find(".qtyVal").val();
        value++;
        $(this).closest('tr').find(".qtyVal").val(value);
        var price = +$(this).closest('tr').find(".price").text();
        $(this).closest('tr').find(".productTotalPrice").text(value * price);
    });
    myNewTable.on('click', 'tbody tr #subBtn', function () {
        var value = $(this).closest('tr').find(".qtyVal").val();
        if (value != 1) {
            value--;
            $(this).closest('tr').find(".qtyVal").val(value);
            var price = +$(this).closest('tr').find(".price").text();
            $(this).closest('tr').find(".productTotalPrice").text(value * price);
        }
    });
    var totalBeforeDiscount = 0;
    $(document).on('click', '#secondNext', function () {
        if(table.rows().count() !=0) {
            $('.firstInfo').append(`
                        <h6 class="billTitle"> visitors</h6>
                        <div class="items">
                            <div class="itemsHead row visitorItemRows">
                                <span class="col">type</span>
                                <span class="col"> Quantity </span>
                                <span class="col"> price </span>
                            </div>
                        </div>
            `)
            $('.visitorType').each(function () {
                var div = $(this),
                    count = div.find('span.count').text(),
                    price = div.find('input[name*=price]').val() * parseInt(count),
                    visitor = div.find('span.visitor').text();

                if (count != 0) {
                    $('.visitorItemRows').after(
                        `<div class="item row insertRows">
                        <span class="col"> ${visitor}</span>
                        <span class="col"> x${count}</span>
                        <span class="col"> ${price} EGP</span>
                        </div>`)
                    totalBeforeDiscount += price;
                }
            });
        }else{
            toastr.error("at least one model should be exists");
            $("button[title='products']").removeClass('js-active');
            $("#productsTab").removeClass('js-active');
            $("button[title='visitors']").addClass('js-active');
            $("#visitorsTab").addClass('js-active');
        }
    });
    $(document).on('click', '#thirdPrev', function () {
        $('.insertRows').remove();
        $('.firstInfo').html('');
    });
    var Percent = $('#offerType1'),
        Amount  = $('#offerType2');
    $(document).on('click', '#thirdNext', function () {
        if(myTable.rows().count() !=0) {
            $('.secondInfo').append(`
                <h6 class="billTitle"> products</h6>
                <div class="items">
                   <div class="itemsHead row productsInfoRows">
                     <span class="col">type</span>
                     <span class="col"> Quantity </span>
                     <span class="col"> price </span>
                </div>
            `)
            $('#myNewTable tr').each(function () {
                var div = $(this),
                    name  = div.find('td:first').text(),
                    product_id  = div.find('#spanProductId').attr('data-product_id'),
                    total = parseInt(div.find('span.productTotalPrice').text()),
                    qty = div.find('input.qtyVal').val();
                if (qty != undefined) {
                    $('.productsInfoRows').after(
                        `<div class="item row productInsertRows">
                            <input type="hidden" name="product_id[]" value="${product_id}">
                            <input type="hidden" name="proQtyInput[]" value="${qty}">
                            <input type="hidden" name="proTotalInput[]" value="${total}">
                            <span class="col" id="proName">${name} </span>
                        <span class="col" id="proQty"> x${qty} </span>
                        <span class="col" id="proTotal"> ${total} EGP </span>
                    </div>`)
                    totalBeforeDiscount += total;
                }
            });
        }
        $('#totalPrice').text(totalBeforeDiscount);
        $('#totalInfoPrice').text(totalBeforeDiscount+" EGP")
        $('#totalInfoDiscount').text(0+" EGP")
        $('#totalInfoRevenue').text(totalBeforeDiscount+" EGP")
        $('#revenue').text(totalBeforeDiscount)
        $('#calcDiscount').val('')
        $('.thirdInfo').append(`
                        <h6 class="billTitle"> Totals </h6>
                        <ul>
                            <li><label> total price : </label> <strong id="totalInfoPrice">${totalBeforeDiscount} EGP</strong></li>
                            <li><label> Discount : </label> <strong id="totalInfoDiscount">0 EGP</strong></li>
                            <li><label> Revenue : </label> <strong id="totalInfoRevenue">${totalBeforeDiscount} EGP</strong></li>
            `)
    });
    var totalPrice = parseInt($('#totalPrice').text());
    Percent.prop("checked", true);
    $('#revenue').text(totalBeforeDiscount)
    $("#calcDiscount").on("keyup change", function(e) {
        if (Percent.is(':checked'))
            checkPercent()
        else if (Amount.is(':checked'))
            checkAmount()
    });
    Percent.change(function() {
        checkPercent()
    });
    function checkPercent(){
        if($('#calcDiscount').val() > 100 || $('#calcDiscount').val() < 0){
            toastr.error("enter valid discount percent !");
            $('#calcDiscount').val('');
            $('#totalInfoDiscount').text(0+ " EGP")
            $('#discount').text('0');
            $('#revenue').text($('#totalPrice').text());
        }else {
            $('#discount').text($('#calcDiscount').val() + "%")
            var after = (parseInt($('#totalPrice').text()) - $('#calcDiscount').val() * parseInt($('#totalPrice').text()) / 100).toFixed(2);
            $('#revenue').text(after)
            $('#totalInfoPrice').text($('#totalPrice').text()+" EGP")
            $('#totalInfoRevenue').text(after+" EGP")
            $('#totalInfoDiscount').text($('#calcDiscount').val()+"%")
            calculateChange()
        }
    }
    function checkAmount(){
        if($('#calcDiscount').val() > parseInt($('#totalPrice').text() || $('#calcDiscount').val() < 0)){
            toastr.error("discount amount more than total !");
            $('#totalInfoDiscount').text(0+ " EGP")
            $('#calcDiscount').val('');
            $('#discount').text('0');
            $('#revenue').text($('#totalPrice').text());
        }else {
            $('#discount').text($('#calcDiscount').val()||0)
            var after = (parseInt($('#totalPrice').text()) - $('#calcDiscount').val());
            $('#revenue').text(after)
            $('#totalInfoPrice').text($('#totalPrice').text()+" EGP")
            $('#totalInfoRevenue').text(after+" EGP")
            $('#totalInfoDiscount').text($('#calcDiscount').val()+ " EGP")
            calculateChange()
        }
    }
    Amount.change(function() {
        checkAmount()
    });


    function calculateChange(){
            if(amountCash.val() > parseInt($('#revenue').text()))
                $("#change").text(amountCash.val()-parseInt($('#revenue').text())||0);
            else
                $("#change").text('0');

            $('#paid').text(amountCash.val()||0);
    }

    $(document).on('click', '#lastPrev', function () {
        $('.productInsertRows').remove();
        $('.secondInfo').html('');
        $('.thirdInfo').html('')
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    $(document).on('click', '#printBtn', function () {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById('bill').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();
        return true;
    });
    function DeleteRows(){
        $('.firstTable').DataTable().clear().draw();
        $('.visitorType').each(function () {
            $(this).find('span.count').text('0');
        });
    }
    $('.inputCount').focusout(function(){
        var type = $(this).parent().parent().find('.visitor').text();
        var visitor_type_id = $(this).parent().parent().find('#visitor_type_id').val();
        for(var i = 0 ; i < $(this).val() ; i++) {
            appendRow(visitor_type_id, type, $(this).parent().parent().find('input').val())
        }
    });
</script>
