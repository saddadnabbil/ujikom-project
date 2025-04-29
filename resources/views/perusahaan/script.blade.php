<script>
    $(function () {
        // Initialize DataTable
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('perusahaan.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_perusahaan', name: 'nama_perusahaan' },
                { data: 'alamat', name: 'alamat' },
                { data: 'no_telp', name: 'no_telp' },
                { data: 'fax', name: 'fax' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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
        $('#datatable').on('click', '.perusahaan-detail', function () {
            let id = $(this).data('id');
            let url = "{{ route('api.perusahaan.show', ':id') }}".replace(':id', id);

            // Show loading state in modal fields
            $('#showPerusahaanModal input, #showPerusahaanModal textarea').val('Memuat data...');

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    // Populate modal fields with data
                    $('#showPerusahaanModal #show_nama_perusahaan').val(response.data.nama_perusahaan);
                    $('#showPerusahaanModal #show_alamat').val(response.data.alamat);
                    $('#showPerusahaanModal #show_no_telp').val(response.data.no_telp);
                    $('#showPerusahaanModal #show_fax').val(response.data.fax);
                    $('#showPerusahaanModal').modal('show');
                },
                error: function (xhr) {
                    // Handle errors
                    alert('Gagal mengambil data perusahaan. Silakan coba lagi.');
                    console.error(xhr.responseText);
                }
            });
        });

        // Handle the edit button click
        $('#datatable').on('click', '.perusahaan-edit', function () {
            let id = $(this).data('id');
            let url = "{{ route('api.perusahaan.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('perusahaan.update', ':id') }}".replace(':id', id);

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    // Populate modal fields with data
                    $('#editPerusahaanModal #edit-perusahaan-form').attr('action', formActionURL);
                    $('#editPerusahaanModal #edit_nama_perusahaan').val(response.data.nama_perusahaan);
                    $('#editPerusahaanModal #edit_alamat').val(response.data.alamat);
                    $('#editPerusahaanModal #edit_no_telp').val(response.data.no_telp);
                    $('#editPerusahaanModal #edit_fax').val(response.data.fax);
                    $('#editPerusahaanModal').modal('show');
                },
                error: function (xhr) {
                    // Handle errors
                    alert('Gagal mengambil data perusahaan untuk diedit. Silakan coba lagi.');
                    console.error(xhr.responseText);
                }
            });
        });

    });
</script>
