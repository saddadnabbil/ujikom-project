<script>
    $(function () {
        // Initialize DataTable
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('produk.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama_produk', name: 'nama_produk' },
                { data: 'price', name: 'price' },
                { data: 'action', name: 'action' },
            ]
        });

        // Handle the detail button click
        $('#datatable').on('click', '.product-detail', function () {
            let id = $(this).data('id');
            let url = "{{ route('api.produk.show', ':id') }}".replace(':id', id);

            $('#showProductModal input').each(function () {
                $(this).val('Sedang mengambil data...');
            });

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    let data = response.data;
                    $('#showProductModal #show_product_name').val(data.nama_produk);
                    $('#showProductModal #show_product_price').val(data.price);
                    $('#showProductModal #show_product_jenis').val(data.jenis);
                    $('#showProductModal #show_product_stock').val(data.stock);
                    $('#showProductModal').modal('show');
                },
                error: function () {
                    alert('Gagal mengambil data produk.');
                }
            });
        });

        // Handle the edit button click
        $('#datatable').on('click', '.product-edit', function () {
            let id = $(this).data('id');
            let url = "{{ route('api.produk.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('produk.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    let data = response.data;
                    $('#editProductModal #edit-product-form').attr('action', formActionURL);
                    $('#editProductModal #edit_product_name').val(data.nama_produk);
                    $('#editProductModal #edit_product_price').val(data.price);
                    $('#editProductModal #edit_product_jenis').val(data.jenis);
                    $('#editProductModal #edit_product_stock').val(data.stock);
                    $('#editProductModal input').prop('disabled', false);
                    $('#editProductModal').modal('show');
                },
                error: function () {
                    alert('Gagal mengambil data produk.');
                }
            });
        });
    });
</script>
