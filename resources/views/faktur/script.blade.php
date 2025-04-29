<script>
    function formatRupiah(angka) {
        if (!angka && angka !== 0) return "0";
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function calculateTotals() {
        let total = 0;

        $('.detail-item').each(function() {
            const jumlah = parseFloat($(this).find('.jumlah').val()) || 0;
            const hargaSatuan = parseFloat($(this).find('.harga-satuan').val()) || 0;
            const subtotal = jumlah * hargaSatuan;

            $(this).find('.subtotal').val(subtotal.toFixed(2));
            total += subtotal;
        });

        const ppnPersen = parseFloat($('#ppn').val()) || 0;
        const dp = parseFloat($('#dp').val()) || 0;

        const ppnRupiah = total * (ppnPersen / 100);
        const grandTotal = total + ppnRupiah - dp;

        $('#total_display').val(formatRupiah(total.toFixed(0)));
        $('#ppn_rp_display').val(formatRupiah(ppnRupiah.toFixed(0)));
        $('#grand_total_display').val(formatRupiah(grandTotal.toFixed(0)));

        $('#total').val(total.toFixed(2));
        $('#ppn_rp').val(ppnRupiah.toFixed(2));
        $('#grand_total').val(grandTotal.toFixed(2));
    }

    let itemIndex = 1;

    $(document).ready(function() {
        calculateTotals();
    });

    $(document).on('input', '.jumlah, .harga-satuan, #ppn, #dp', function() {
        calculateTotals();
    });

    $(document).on('change', '.produk-select', function() {
        const selected = $(this).find('option:selected');
        const harga = selected.data('harga') || 0;
        const parent = $(this).closest('.detail-item');
        parent.find('.harga-satuan').val(harga);
        parent.find('.jumlah').trigger('input');
    });

    $('#add-item-btn').click(function() {
        const newItem = $('.detail-item:first').clone();

        newItem.find('select, input').each(function() {
            const name = $(this).attr('name');
            if (name) {
                const newName = name.replace(/\[\d+\]/, `[${itemIndex}]`);
                $(this).attr('name', newName);
            }
            $(this).val('');
        });

        if (newItem.find('.remove-item-btn').length === 0) {
            newItem.append(`
                <div class="col-md-12 text-end mt-2">
                    <button type="button" class="btn btn-danger btn-sm remove-item-btn">Hapus</button>
                </div>
            `);
        }

        $('#detail-items').append(newItem);
        itemIndex++;
    });

    $(document).on('click', '.remove-item-btn', function() {
        if ($('.detail-item').length > 1) {
            $(this).closest('.detail-item').remove();
            calculateTotals();
        } else {
            alert("Minimal satu item harus ada.");
        }
    });
</script>


<script>
    $(function() {
        // Initialize DataTable
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('faktur.index') }}", // Ensure this route is defined in your web.php
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

        // Handle the detail button click
        $('#datatable').on('click', '.faktur-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.faktur.show', ':id') }}".replace(':id', id);

            // Show loading state in modal fields
            $('#showFakturModal input, #showFakturModal textarea').val('Memuat data...');

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Populate modal fields with data
                    $('#showFakturModal #show_customer').val(response.data.customer);
                    $('#showFakturModal #show_perusahaan').val(response.data.perusahaan);
                    $('#showFakturModal #show_tanggal_faktur').val(response.data
                        .tanggal_faktur);
                    $('#showFakturModal #show_total').val(response.data.total);
                    $('#showFakturModal').modal('show');
                },
                error: function(xhr) {
                    // Handle errors
                    alert('Gagal mengambil data faktur. Silakan coba lagi.');
                    console.error(xhr.responseText);
                }
            });
        });

        $('#editFakturModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // The button that triggered the modal
            var fakturId = button.data('id'); // Get the faktur ID from the button
            var url = "{{ route('api.faktur.edit', ':id') }}".replace(':id',
            fakturId); // Replace the ID placeholder with actual faktur ID

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.code === 200) {
                        // Populate the modal with the returned data
                        var data = response.data;
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

                        // Populate the detail items
                        var detailItems = data.details;
                        $('#edit-detail-items').empty(); // Clear any existing items

                        detailItems.forEach(function(item, index) {
                            var newItem = $('#detail-item-template')
                        .clone(); // Clone the template
                            newItem.find('.produk-select').val(item.produk_id);
                            newItem.find('.jumlah').val(item.jumlah);
                            newItem.find('.harga-satuan').val(item.harga_satuan);
                            newItem.find('.subtotal').val(item.subtotal);
                            newItem.removeClass(
                            'd-none'); // Remove hidden class for the template
                            newItem.appendTo('#edit-detail-items');
                        });

                        // Show the modal
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
        
        // Handle delete button click with confirmation
        $('#datatable').on('click', '.delete-notification', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');

            if (confirm('Apakah Anda yakin ingin menghapus faktur ini?')) {
                form.submit();
            }
        });
    });
</script>
