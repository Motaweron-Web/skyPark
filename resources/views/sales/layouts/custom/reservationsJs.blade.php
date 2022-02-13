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

</script>
