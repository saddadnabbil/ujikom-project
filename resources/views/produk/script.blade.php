<script>
    $(function() {
        // Initialize DataTable
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('produk.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_produk',
                    name: 'nama_produk'
                },
                {
                    data: 'price',
                    name: 'price'
                }, // Display formatted price but sort by price
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        // Handle the detail button click
        $('#datatable').on('click', '.product-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.produk.show', ':id') }}".replace(':id', id);

            $('#showProductModal input').each(function() {
                $(this).val('Sedang mengambil data...');
            });

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;
                    $('#showProductModal #show_product_name').val(data.nama_produk);
                    // Format the price for display
                    let formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(data
                        .price);
                    $('#showProductModal #show_product_price').val(formattedPrice);
                    $('#showProductModal #show_product_jenis').val(data.jenis);
                    $('#showProductModal #show_product_stock').val(data.stock);
                    $('#showProductModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data produk.');
                }
            });
        });

        // Handle the edit button click
        $('#datatable').on('click', '.product-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.produk.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('produk.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;
                    $('#editProductModal #edit-product-form').attr('action', formActionURL);
                    $('#editProductModal #edit_product_name').val(data.nama_produk);
                    // Don't format price in edit form to allow proper editing
                    $('#editProductModal #edit_product_price').val(data.price);
                    $('#editProductModal #edit_product_jenis').val(data.jenis);
                    $('#editProductModal #edit_product_stock').val(data.stock);
                    $('#editProductModal input').prop('disabled', false);
                    $('#editProductModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data produk.');
                }
            });
        });
    });

    // Add this to your existing script section or create a new one
    $(document).ready(function() {
        // Format currency input for add product modal
        $('#product_price_display').on('input', function() {
            // Remove non-numeric characters
            let value = $(this).val().replace(/[^\d]/g, '');

            // Store actual value in hidden field
            $('#product_price_actual').val(value);

            // Format with thousand separators
            if (value) {
                let formattedValue = new Intl.NumberFormat('id-ID').format(value);
                $(this).val(formattedValue);
            }
        });

        // Before form submission, ensure the actual value is set
        $('form').on('submit', function() {
            let rawValue = $('#product_price_display').val().replace(/[^\d]/g, '');
            $('#product_price_actual').val(rawValue);
        });
    });

    // Format currency input for edit product modal
    $(document).ready(function() {
        // Function to format number as currency
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Format displayed price when edit modal opens
        $('#datatable').on('click', '.product-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.produk.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('produk.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;
                    $('#editProductModal #edit-product-form').attr('action', formActionURL);
                    $('#editProductModal #edit_product_name').val(data.nama_produk);

                    // Format price for display and save actual price value
                    $('#editProductModal #edit_product_price_display').val(formatRupiah(data
                        .price));
                    $('#editProductModal #edit_product_price_actual').val(data.price);

                    $('#editProductModal #edit_product_jenis').val(data.jenis);
                    $('#editProductModal #edit_product_stock').val(data.stock);
                    $('#editProductModal input').prop('disabled', false);
                    $('#editProductModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data produk.');
                }
            });
        });

        // Handle formatting as user types in edit price field
        $('#edit_product_price_display').on('input', function() {
            // Remove non-numeric characters
            let value = $(this).val().replace(/[^\d]/g, '');

            // Store actual value in hidden field
            $('#edit_product_price_actual').val(value);

            // Format with thousand separators
            if (value) {
                let formattedValue = formatRupiah(value);
                $(this).val(formattedValue);
            }
        });

        // Before form submission
        $('#edit-product-form').on('submit', function() {
            let rawValue = $('#edit_product_price_display').val().replace(/[^\d]/g, '');
            $('#edit_product_price_actual').val(rawValue);
        });
    });
</script>
