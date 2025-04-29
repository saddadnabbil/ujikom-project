<script>
    $(function () {
        $('#filter').click(function () {
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            $.ajax({
                url: "{{ route('cash-transaction-expenditures.filter') }}",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                },
                success: function (res) {
                    $('#datatable-wrap').removeAttr('style');

                    Toastify({
                        text: "Berhasil mengambil data",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    $('#datatable').DataTable({
                        data: res.data,
                        destroy: true,
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                            { data: 'note', name: 'note' },
                            { data: 'expenditure', name: 'expenditure' },
                            { data: 'amount', name: 'amount' },
                            { data: 'date', name: 'date' },
                            { data: 'users.name', name: 'users.name' },
                        ]
                    });
                },
                error: function () {
                    $('#datatable-wrap').css('display', 'none');

                    Toastify({
                        text: "Kesalahan internal!",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#f3616d",
                    }).showToast()
                }
            });
        });
    });
</script>