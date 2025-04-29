<script>
    $(function () {
        // Initialize DataTable for customer history
        $('#datatable-history').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index.history') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama_customer', name: 'nama_customer' },
                { data: 'email', name: 'email' },
                { data: 'no_telp', name: 'no_telp' },
                { data: 'alamat', name: 'alamat' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Confirmation for restore action
        $(document).on('submit', 'form[action*="restore"]', function (e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengembalikan data customer ini?')) {
                this.submit();
            }
        });

        // Confirmation for permanent delete action
        $(document).on('submit', 'form[action*="destroy"]', function (e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data customer ini secara permanen?')) {
                this.submit();
            }
        });
    });
</script>
