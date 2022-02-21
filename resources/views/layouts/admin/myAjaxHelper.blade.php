<script>
    // Show Data Using YAJRA
    async function showData(routeOfShow,columns) {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: routeOfShow,
                columns: columns,
                order: [
                    [0, "desc"]
                ],
                "language": {
                    "sProcessing": "جاري التحميل ..",
                    "sLengthMenu": "اظهار _MENU_ سجل",
                    "sZeroRecords": "لا يوجد نتائج",
                    "sInfo": "اظهار _START_ الى  _END_ من _TOTAL_ سجل",
                    "sInfoEmpty": "لا نتائج",
                    "sInfoFiltered": "للبحث",
                    "sSearch": "بحث :    ",
                    "oPaginate": {
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                    },
                    buttons: {
                        copyTitle: 'تم النسخ للحافظة <i class="fa fa-check-circle text-success"></i>',
                        copySuccess: {
                            1: "تم نسخ صف واحد",
                            _: "تم نسخ %d صفوف بنجاح"
                        },
                    }
                },

                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: 'نسخ',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'print',
                        text: 'طباعة',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: 'اكسيل',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'colvis',
                        text: 'عرض',
                        className: 'btn-primary'
                    },
                ]
            });
        }

    // Delete Using Ajax
    function deleteScript(routeOfDelete) {
        $(document).ready(function () {
            //Show data in the delete form
            $('#delete_modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var title = button.data('title')
                var modal = $(this)
                modal.find('.modal-body #delete_id').val(id);
                modal.find('.modal-body #title').text(title);
            });
        });
        $(document).on('click', '#delete_btn', function (event) {
            var id = $("#delete_id").val();
            $.ajax({
                type: 'POST',
                url: routeOfDelete,
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                },
                success: function (data) {
                    if (data.status === 200) {
                        $("#dismiss_delete_modal")[0].click();
                        $('#dataTable').DataTable().ajax.reload();
                        toastr.success(data.message)
                    } else {
                        $("#dismiss_delete_modal")[0].click();
                        toastr.error(data.message)
                    }
                }
            });
        });
    }
</script>
