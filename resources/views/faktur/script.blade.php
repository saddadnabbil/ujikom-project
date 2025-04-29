<script>
    // Format number as Rupiah currency
    function formatRupiah(angka) {
        if (!angka && angka !== 0) return "0";
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Calculate Totals (shared logic for both modals)
    function calculateTotals(modalId) {
        let total = 0;

        $(`${modalId} .detail-item`).each(function() {
            const qty = parseFloat($(this).find('.jumlah').val()) || 0;
            const price = parseFloat($(this).find('.harga-satuan').val()) || 0;
            const subtotal = qty * price;

            $(this).find('.subtotal').val(subtotal.toFixed(2));
            total += subtotal;
        });

        const ppn = parseFloat($(`${modalId} .ppn`).val()) || 0;
        const dp = parseFloat($(`${modalId} .dp`).val()) || 0;
        const ppnRupiah = total * (ppn / 100);
        const grandTotal = total + ppnRupiah - dp;

        $(`${modalId} .total`).val(total.toFixed(2));
        $(`${modalId} .grand-total`).val(grandTotal.toFixed(2));
    }

    // Add Item Row Function (for Create and Edit)
    function addItem(modalId, templateId, containerId, indexVar) {
        const newItem = $(templateId).clone().removeClass('d-none').removeAttr('id');

        newItem.find('select, input').each(function() {
            const name = $(this).attr('name');
            if (name) {
                // Ganti cara replace: ubah semua [x] menjadi index baru
                const baseName = name.replace(/\[\d+\]/g, `[${window[indexVar]}]`);
                $(this).attr('name', baseName);
            }
            $(this).prop('disabled', false); // pastikan tidak disabled
            $(this).val('');
        });

        $(containerId).append(newItem);
        window[indexVar]++;

        calculateTotals(modalId);
    }


    // Remove Item Row (shared logic for both modals)
    $(document).on('click', '.remove-item-btn', function() {
        const container = $(this).closest('.modal-body');
        if (container.find('.detail-item').length > 1) {
            $(this).closest('.detail-item').remove();
            calculateTotals(`#${container.closest('.modal').attr('id')}`);
        } else {
            alert("Minimal satu item harus ada.");
        }
    });

    $(document).on('change', '.produk-select', function() {
        const harga = $(this).find(':selected').data('harga') || 0; // Ensure the price is fetched correctly
        const row = $(this).closest('.detail-item');
        row.find('.harga-satuan').val(harga); // Set the price in the corresponding field
        row.find('.jumlah').trigger('input'); // Recalculate subtotal after price change
    });
    // Recalculate totals on input (shared logic for both modals)
    $(document).on('input', '.jumlah, .harga-satuan, .ppn, .dp', function() {
        const modalId = `#${$(this).closest('.modal').attr('id')}`;
        calculateTotals(modalId);
    });

    let createItemIndex = 1; // Starting index for create modal items
    $('#add-item-btn').click(function() {
        console.log('Add Item button clicked for Create modal'); // Debugging line
        addItem('#addFakturModal', '#detail-item-template', '#detail-items', 'createItemIndex');
    });

    // EDIT modal logic
    let editItemIndex = 0; // Starting index for edit modal items
    $('#edit-add-item-btn').click(function() {
        addItem('#editFakturModal', '#edit-detail-template', '#edit-detail-items', 'editItemIndex');
    });

    // When showing edit modal, reset counters
    $('#editFakturModal').on('show.bs.modal', function() {
        editItemIndex = 0;
        $('#edit-detail-items').empty(); // Clear previous items when opening the modal
    });

    // Initialize calculation on modal show (for both Create and Edit)
    $('#editFakturModal, #createFakturModal').on('shown.bs.modal', function() {
        const modalId = `#${$(this).attr('id')}`;
        calculateTotals(modalId);
    });
</script>

<script>
    $(function() {
        // Initialize DataTable for Faktur list
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('faktur.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'perusahaan',
                    name: 'perusahaan'
                },
                {
                    data: 'tanggal_faktur',
                    name: 'tanggal_faktur'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                processing: "Memuat data...",
                emptyTable: "Tidak ada data tersedia",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                search: "Cari:",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
            }
        });

        // Fetch and show Faktur details in a modal
        $('#datatable').on('click', '.faktur-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.faktur.show', ':id') }}".replace(':id', id);

            // Show loading state in modal fields
            $('#showFakturModal input').val('Memuat...');

            // Clear detail table before load
            $('#detailFakturItems').empty();

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    const data = response.data;

                    // Populate main fields
                    $('#show_no_faktur').val(data.no_faktur);
                    $('#show_customer').val(data.customer);
                    $('#show_perusahaan').val(data.perusahaan);
                    $('#show_tanggal_faktur').val(data.tanggal_faktur);
                    $('#show_due_date').val(data.due_date);
                    $('#show_metode_bayar').val(data.metode_bayar);
                    $('#show_ppn').val(data.ppn);
                    $('#show_dp').val(data.dp);
                    $('#show_total').val(data.total);
                    $('#show_grand_total').val(data.grand_total);

                    // Populate detail items in the table
                    let detailItems = data.details;
                    detailItems.forEach((item, index) => {
                        $('#detailFakturItems').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.produk}</td>
                        <td>${item.jumlah}</td>
                        <td>${formatRupiah(item.harga_satuan)}</td>
                        <td>${formatRupiah(item.subtotal)}</td>
                    </tr>
                `);
                    });

                    $('#showFakturModal').modal('show');
                },
                error: function(xhr) {
                    alert('Gagal mengambil data faktur. Silakan coba lagi.');
                    console.error(xhr.responseText);
                }
            });
        });

        // Handle edit Faktur modal
        $('#editFakturModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var fakturId = button.data('id');

            var url = "{{ route('api.faktur.edit', ':id') }}".replace(':id', fakturId);
            var formAction = "{{ route('faktur.update', ':id') }}".replace(':id', fakturId);

            // Set form action to correct update route
            $('#edit-faktur-form').on('submit', function(e) {
                const formData = $(this).serializeArray();
                console.log('Form data on submit:', formData);
            });
            // Set form action to correct update route
            $('#edit-faktur-form').attr('action', formAction);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.code === 200) {
                        var data = response.data;

                        // Set main fields
                        $('#edit_no_faktur').val(data.no_faktur);
                        $('#edit_customer_id').val(data.customer_id);
                        $('#edit_perusahaan_id').val(data.perusahaan_id);
                        $('#edit_tanggal_faktur').val(data.tanggal_faktur);
                        $('#edit_due_date').val(data.due_date);
                        $('#edit_metode_bayar').val(data.metode_bayar);
                        $('#edit_ppn').val(data.ppn);
                        $('#edit_dp').val(data.dp);
                        $('#edit_total').val(data.total);
                        $('#edit_grand_total').val(data.grand_total);

                        // Populate detail items in the edit modal
                        var detailItems = data.details;
                        $('#edit-detail-items').empty(); // Clear previous items

                        detailItems.forEach(function(item, index) {
                            var newItem = $('#edit-detail-template').clone()
                                .removeClass('d-none')
                                .removeAttr('id');

                            // Ubah name attribute setiap input/select sesuai index
                            newItem.find('select, input').each(function() {
                                const name = $(this).attr('name');
                                if (name) {
                                    const newName = name.replace(/\[\d+\]/,
                                        `[${index}]`);
                                    $(this).attr('name', newName);
                                }
                            });

                            // Set nilai input
                            newItem.find('.produk-select').val(item.id_produk
                                .toString()); // Pastikan id_produk berupa string
                            newItem.find('.harga-satuan').val(item.harga_satuan);
                            newItem.find('.jumlah').val(item.jumlah);

                            // Hitung subtotal secara manual
                            var subtotal = (parseFloat(item.harga_satuan) || 0) * (
                                parseFloat(item.jumlah) || 0);
                            newItem.find('.subtotal').val(subtotal.toFixed(2));

                            // Tambahkan item ke container
                            $('#edit-detail-items').append(newItem);

                            // Perbarui index
                            editItemIndex = index + 1;
                        });

                        $('#editFakturModal').modal('show');
                    } else {
                        alert('Error fetching faktur data');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while fetching the faktur data');
                }
            });
        });

        // Handle delete confirmation
        $('#datatable').on('click', '.delete-notification', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            if (confirm('Apakah Anda yakin ingin menghapus faktur ini?')) {
                form.submit();
            }
        });
    });
</script>
