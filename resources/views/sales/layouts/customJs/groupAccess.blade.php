<script>
        var table = $('.customDataTable').DataTable({
            responsive: true,
            // "ordering": true,
            // columnDefs: [{
            //   'targets': [4, 5],
            //   'orderable': false
            // }, ]
        });

        $(document).ready(function(){
            var url = window.location.href;
           if (url.includes('search')){
               getSearchValue(url)

               var slug = url.substring(url.indexOf("=") + 1);


               $('#searchValue').val(slug)
           }
        })

    $(document).on('click','#searchButton',function(){
        var searchValue = $('#searchValue').val();
        if (searchValue.length == 0){
            toastr.info('Please fill this input')
            return true;
        }

        var url = "{{route('groupAccess.index')}}?search="+searchValue

        getSearchValue(url)

    })

        //////////////// البحث ///////////
        function getSearchValue(url){
            $.ajax({
                type: 'GET',
                url: url,
                beforeSend: function () {
                    window.history.pushState({path:url},'',url);
                    $('.spinner').show()
                    table.clear().draw();
                },
                complete: function (data) {
                    $('.spinner').hide()
                },
                success: function (data) {
                    if (data.status === 200) {
                        var Rows = data.backArray;

                        $.each(Rows, function(key,val){
                            table.row.add(data.backArray[key]).draw(false);
                        })

                    }else if(data.status === 300){
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
</script>
