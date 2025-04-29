<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        // Initialize DataTable
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_customer',
                    name: 'nama_customer'
                },
                {
                    data: 'perusahaan_cust',
                    name: 'perusahaan_cust'
                }, // Adjusted column name
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Handle show customer details
        $('#datatable').on('click', '.customer-detail', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.customer.show', ':id') }}".replace(':id', id);

            // Reset modal inputs
            $('#showCustomerModal input, #showCustomerModal textarea').each(function() {
                $(this).val('Sedang mengambil data...');
            });

            // Fetch customer details via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    loadingAlert.slideUp();

                    // Populate modal fields with customer data
                    $('#showCustomerModal #show_nama_customer').val(response.data
                        .nama_customer);
                    $('#showCustomerModal #show_perusahaan_cust').val(response.data
                        .perusahaan_cust);
                    $('#showCustomerModal #show_alamat').val(response.data.alamat);

                    // Show the modal
                    $('#showCustomerModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data customer.');
                }
            });
        });

        // Handle the edit button click
        $('#datatable').on('click', '.customer-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.customer.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('customer.update', ':id') }}".replace(':id', id);

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Enable inputs and populate modal fields
                    $('#editCustomerModal input, #editCustomerModal textarea').prop(
                        'disabled', false);
                    $('#editCustomerModal #edit-customer-form').attr('action',
                        formActionURL);
                    $('#editCustomerModal #edit_nama_customer').val(response.data
                        .nama_customer);
                    $('#editCustomerModal #edit_perusahaan_cust').val(response.data
                        .perusahaan_cust);
                    $('#editCustomerModal #edit_alamat').val(response.data.alamat);

                    // Show the modal
                    $('#editCustomerModal').modal('show');
                },
                error: function(xhr) {
                    // Handle errors
                    alert('Gagal mengambil data customer untuk diedit. Silakan coba lagi.');
                    console.error(xhr.responseText);
                }
            });
        });

    });
</script>
