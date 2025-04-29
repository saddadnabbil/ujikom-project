<script>
    $(function() {
        // Initialize DataTable for customer history
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index.history') }}",
            columns: [                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama_customer', name: 'nama_customer' },
                { data: 'perusahaan_cust', name: 'perusahaan_cust' }, // Adjusted column name
                { data: 'alamat', name: 'alamat' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
