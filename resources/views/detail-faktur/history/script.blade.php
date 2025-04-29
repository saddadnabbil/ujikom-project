<script>
    $(function () {
        // Initialize DataTable for faktur history
        $('#datatable-history').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('faktur.index.history') }}", 
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'customer', name: 'customer' },
                { data: 'perusahaan', name: 'perusahaan' },
                { data: 'tanggal_faktur', name: 'tanggal_faktur' },
                { data: 'total', name: 'total' },
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

        // Confirmation for restore action
        $(document).on('submit', 'form[action*="restore"]', function (e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengembalikan data faktur ini?')) {
                this.submit();
            }
        });

        // Confirmation for permanent delete action
        $(document).on('submit', 'form[action*="destroy"]', function (e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data faktur ini secara permanen?')) {
                this.submit();
            }
        });
    });
</script>
