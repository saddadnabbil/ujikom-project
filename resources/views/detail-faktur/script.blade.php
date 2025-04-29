<script>
    $(function () {
        // Initialize DataTable
        $('#datatable-detail').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('detail-faktur.index', $faktur->id) }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'produk', name: 'produk' },
                { data: 'jumlah', name: 'jumlah' },
                { data: 'harga_satuan', name: 'harga_satuan' },
                { data: 'subtotal', name: 'subtotal' },
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

        // Handle Show Detail Faktur
        $('#datatable-detail').on('click', '.detail-faktur-show', function () {
            let id = $(this).data('id');
            let url = "{{ route('detail-faktur.index', $faktur->id) }}/" + id;

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#showDetailFakturModal #show_produk').val(response.data.produk);
                    $('#showDetailFakturModal #show_jumlah').val(response.data.jumlah);
                    $('#showDetailFakturModal #show_harga_satuan').val(response.data.harga_satuan);
                    $('#showDetailFakturModal #show_subtotal').val(response.data.subtotal);
                    $('#showDetailFakturModal').modal('show');
                },
                error: function () {
                    alert('Gagal mengambil data detail faktur.');
                }
            });
        });

        // Handle Edit Detail Faktur
        $('#datatable-detail').on('click', '.detail-faktur-edit', function () {
            let id = $(this).data('id');
            let url = "{{ route('detail-faktur.index', $faktur->id) }}/" + id + "/edit";

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#editDetailFakturModal #edit_produk_id').val(response.data.produk_id);
                    $('#editDetailFakturModal #edit_jumlah').val(response.data.jumlah);
                    $('#editDetailFakturModal #edit_harga_satuan').val(response.data.harga_satuan);
                    $('#editDetailFakturModal #edit_subtotal').val(response.data.subtotal);
                    $('#editDetailFakturModal #edit-detail-faktur-form').attr('action', "{{ route('detail-faktur.index', $faktur->id) }}/" + id);
                    $('#editDetailFakturModal').modal('show');
                },
                error: function () {
                    alert('Gagal mengambil data detail faktur.');
                }
            });
        });
    });
</script>