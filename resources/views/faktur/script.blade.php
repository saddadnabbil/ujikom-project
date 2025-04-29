<script>
   // Format number as Rupiah currency
function formatRupiah(angka) {
    if (!angka && angka !== 0) return "0";
    return new Intl.NumberFormat('id-ID').format(angka);
}

// Parse Rupiah formatted string back to number
function parseRupiah(rupiahStr) {
    return parseFloat(rupiahStr.replace(/[^\d,-]/g, '').replace(/\./g, '').replace(',', '.')) || 0;
}

// Calculate Totals (shared logic for both modals)
function calculateTotals(modalId) {
    let total = 0;

    $(`${modalId} .detail-item:visible`).each(function() {
        const qty = parseFloat($(this).find('.jumlah').val()) || 0;
        const price = parseFloat($(this).find('.harga-satuan').val()) || 0;
        const subtotal = qty * price;

        $(this).find('.subtotal').val(subtotal.toFixed(2));
        $(this).find('.subtotal-display').val(formatRupiah(subtotal));
        total += subtotal;
    });

    const ppn = parseFloat($(`${modalId} .ppn`).val()) || 0;
    const dp = parseFloat($(`${modalId} #dp`).val()) || 0;
    const ppnRupiah = total * (ppn / 100);
    const grandTotal = total + ppnRupiah - dp;

    $(`${modalId} #total`).val(total.toFixed(2));
    $(`${modalId} #total_display`).val(formatRupiah(total));
    $(`${modalId} #grand_total`).val(grandTotal.toFixed(2));
    $(`${modalId} #grand_total_display`).val(formatRupiah(grandTotal));
}

// Function to prepare form data before submission
function prepareFormForSubmission(formId) {
    console.log(`Preparing form ${formId} for submission`);
    let isValid = true;
    let hasEmptyRequiredFields = false;
    
    // Fix indexing for details items and validate required fields
    $(`#${formId} .detail-item:visible`).each(function(index) {
        const row = $(this);
        
        // Get values we need to check
        const productSelect = row.find('.produk-select');
        const qty = row.find('.jumlah');
        const priceDisplay = row.find('.harga-satuan-display');
        const priceHidden = row.find('.harga-satuan');
        
        // Set default values if empty
        if (!qty.val()) {
            qty.val(1);
        }
        
        // Check required fields
        if (!productSelect.val()) {
            console.error(`Missing product selection in row ${index+1}`);
            productSelect.addClass('is-invalid');
            hasEmptyRequiredFields = true;
            isValid = false;
        } else {
            productSelect.removeClass('is-invalid');
            
            // If product is selected but price is empty, try to set it from the data attribute
            if (!priceHidden.val() || priceHidden.val() == "0") {
                const selectedPrice = productSelect.find(':selected').data('harga') || 0;
                priceHidden.val(selectedPrice);
                priceDisplay.val(formatRupiah(selectedPrice));
            }
        }
        
        // Update all field names to ensure they have correct indexing
        row.find('select, input').each(function() {
            const currentName = $(this).attr('name');
            if (currentName && currentName.includes('details[')) {
                // Extract the field name (id_produk, qty, price, subtotal)
                const fieldMatch = currentName.match(/details\[\d+\]\[(.*?)\]/);
                if (fieldMatch && fieldMatch[1]) {
                    const fieldName = fieldMatch[1];
                    // Create new name with correct index
                    const newName = `details[${index}][${fieldName}]`;
                    $(this).attr('name', newName);
                    console.log(`Renamed ${currentName} to ${newName}`);
                }
            }
        });
        
        // Debug log for this row
        console.log(`Row ${index} after preparation:`, {
            product: productSelect.val(),
            qty: qty.val(),
            price: priceHidden.val(),
            displayPrice: priceDisplay.val()
        });
    });
    
    if (hasEmptyRequiredFields) {
        alert("Ada field yang belum diisi. Mohon lengkapi semua data.");
        return false;
    }
    
    // Everything looks good
    return isValid;
}

// Add Item Row Function (for Create and Edit)
function addItem(modalId, templateId, containerId, indexVar) {
    const newItem = $(templateId).clone().removeClass('d-none').removeAttr('id');

    newItem.find('select, input').each(function() {
        const name = $(this).attr('name');
        if (name) {
            // Update index in field names
            const baseName = name.replace(/\[\d+\]/g, `[${window[indexVar]}]`);
            $(this).attr('name', baseName);
        }
        
        // Ensure fields aren't disabled
        $(this).prop('disabled', false);
        
        // Clear values except for specific fields
        if (!$(this).hasClass('harga-satuan-display') && !$(this).hasClass('subtotal-display')) {
            // Default quantity to 1
            if ($(this).hasClass('jumlah')) {
                $(this).val(1);
            } else {
                $(this).val('');
            }
        }
    });

    $(containerId).append(newItem);
    window[indexVar]++;

    calculateTotals(modalId);
    
    // Set focus on the product dropdown of the new row
    $(containerId).find('.detail-item:last .produk-select').focus();
}

// Remove Item Row (shared logic for both modals)
$(document).on('click', '.remove-item-btn', function() {
    const container = $(this).closest('.modal-body');
    if (container.find('.detail-item:visible').length > 1) {
        $(this).closest('.detail-item').remove();
        calculateTotals(`#${container.closest('.modal').attr('id')}`);
    } else {
        alert("Minimal satu item harus ada.");
    }
});

// Handle product selection change
$(document).on('change', '.produk-select', function() {
    const selectedOption = $(this).find(':selected');
    const harga = selectedOption.data('harga') || 0;
    const row = $(this).closest('.detail-item');
    
    // Update both hidden and display fields
    row.find('.harga-satuan').val(harga);
    row.find('.harga-satuan-display').val(formatRupiah(harga));
    
    // Ensure quantity has a default value
    if (!row.find('.jumlah').val()) {
        row.find('.jumlah').val(1);
    }
    
    // Trigger recalculation
    row.find('.jumlah').trigger('input');
});

// Handle Rupiah format for price inputs
$(document).on('input', '.harga-satuan-display', function() {
    const rawValue = $(this).val().replace(/[^\d]/g, '');
    const numericValue = parseInt(rawValue) || 0;
    
    // Update hidden field with numeric value
    $(this).closest('.input-group').find('.harga-satuan').val(numericValue);
    
    // Update display with formatted value
    if (rawValue) {
        $(this).val(formatRupiah(numericValue));
    }
    
    // Recalculate the row
    const row = $(this).closest('.detail-item');
    const qty = parseFloat(row.find('.jumlah').val()) || 0;
    const subtotal = numericValue * qty;
    
    row.find('.subtotal').val(subtotal.toFixed(2));
    row.find('.subtotal-display').val(formatRupiah(subtotal));
    
    // Update totals
    const modalId = `#${$(this).closest('.modal').attr('id')}`;
    calculateTotals(modalId);
});

// Recalculate totals on input changes
$(document).on('input', '.jumlah, .ppn', function() {
    const row = $(this).closest('.detail-item');
    if ($(this).hasClass('jumlah')) {
        const qty = parseFloat($(this).val()) || 0;
        const price = parseFloat(row.find('.harga-satuan').val()) || 0;
        const subtotal = qty * price;
        
        row.find('.subtotal').val(subtotal.toFixed(2));
        row.find('.subtotal-display').val(formatRupiah(subtotal));
    }
    
    // Update totals
    const modalId = `#${$(this).closest('.modal').attr('id')}`;
    calculateTotals(modalId);
});

// Handle Rupiah format for DP input
$('#dp_display').on('input', function() {
    const rawValue = $(this).val().replace(/[^\d]/g, '');
    const numericValue = parseInt(rawValue) || 0;
    
    // Update hidden field with numeric value
    $('#dp').val(numericValue);
    
    // Update display with formatted value
    if (rawValue) {
        $(this).val(formatRupiah(numericValue));
    }
    
    // Recalculate totals
    calculateTotals(`#${$(this).closest('.modal').attr('id')}`);
});

// For the edit modal DP field
$('#edit_dp_display').on('input', function() {
    const rawValue = $(this).val().replace(/[^\d]/g, '');
    const numericValue = parseInt(rawValue) || 0;
    
    // Update hidden field with numeric value
    $('#edit_dp').val(numericValue);
    
    // Update display with formatted value
    if (rawValue) {
        $(this).val(formatRupiah(numericValue));
    }
    
    // Recalculate totals
    calculateTotals('#editFakturModal');
});

// Form submission handlers with fixes
$('#addFakturModal form').on('submit', function(e) {
    e.preventDefault();
    if (prepareFormForSubmission('addFakturModal')) {
        // Log form data for debugging before submission
        console.log("Form data before submission:");
        $(this).find('input[name], select[name]').each(function() {
            console.log(`${$(this).attr('name')}: ${$(this).val()}`);
        });
        this.submit();
    }
});

$('#edit-faktur-form').on('submit', function(e) {
    e.preventDefault();
    if (prepareFormForSubmission('editFakturModal')) {
        // Log form data for debugging before submission
        console.log("Form data before submission:");
        $(this).find('input[name], select[name]').each(function() {
            console.log(`${$(this).attr('name')}: ${$(this).val()}`);
        });
        this.submit();
    }
});

let createItemIndex = 1; // Starting index for create modal items
$('#add-item-btn').click(function() {
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

// Initialize calculation on modal show and set default values for first row
$('#addFakturModal').on('shown.bs.modal', function() {
    // Set default value for first row quantity
    $('#detail-items .detail-item:first .jumlah').val(1);
    calculateTotals('#addFakturModal');
});

$('#editFakturModal').on('shown.bs.modal', function() {
    calculateTotals('#editFakturModal');
});

// Add immediate debugging for dynamic detail rows
$(document).on('change', '.produk-select, .jumlah, .harga-satuan-display', function() {
    const row = $(this).closest('.detail-item');
    const rowIndex = row.index();
    const produkValue = row.find('.produk-select').val();
    const qtyValue = row.find('.jumlah').val();
    const priceValue = row.find('.harga-satuan').val();
    const displayPrice = row.find('.harga-satuan-display').val();
    
    console.log(`Row ${rowIndex} updated:`, {
        produk: produkValue,
        qty: qtyValue,
        price: priceValue,
        displayPrice: displayPrice
    });
});

// DataTable Definition with Rupiah format
$(function() {
    // Set default values for first row on document ready
    if ($('#detail-items .detail-item').length > 0) {
        if (!$('#detail-items .detail-item:first .jumlah').val()) {
            $('#detail-items .detail-item:first .jumlah').val(1);
        }
    }

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
                name: 'total',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return 'Rp ' + formatRupiah(data);
                    }
                    return data;
                }
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
                        console.log(`Item ${index + 1}:`, item);
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
    $('#datatable').on('click', '.faktur-edit', function() {
        let id = $(this).data('id');
        let url = "{{ route('api.faktur.edit', ':id') }}".replace(':id', id);
        let formAction = "{{ route('faktur.update', ':id') }}".replace(':id', id);

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

                    // Format monetary values
                    $('#edit_dp').val(data.dp);
                    $('#edit_dp_display').val(formatRupiah(data.dp));
                    $('#edit_total').val(data.total);
                    $('#edit_total_display').val(formatRupiah(data.total));
                    $('#edit_grand_total').val(data.grand_total);
                    $('#edit_grand_total_display').val(formatRupiah(data.grand_total));

                    // Populate detail items in the edit modal
                    var detailItems = data.details;
                    $('#edit-detail-items').empty(); // Clear previous items

                    detailItems.forEach(function(item, index) {
                        var newItem = $('#edit-detail-template').clone()
                            .removeClass('d-none')
                            .removeAttr('id');

                        // Update name attributes with correct index
                        newItem.find('select, input').each(function() {
                            const name = $(this).attr('name');
                            if (name) {
                                const newName = name.replace(/\[\d+\]/, `[${index}]`);
                                $(this).attr('name', newName);
                            }
                        });

                        // Set values with proper formatting
                        newItem.find('.produk-select').val(item.id_produk.toString());
                        newItem.find('.jumlah').val(item.jumlah || item.qty || 1);

                        // For price, update both actual and display fields
                        const price = parseFloat(item.harga_satuan || item.price || 0);
                        newItem.find('.harga-satuan').val(price);
                        newItem.find('.harga-satuan-display').val(formatRupiah(price));

                        // Calculate and format subtotal
                        const qty = parseFloat(item.jumlah || item.qty || 1);
                        var subtotal = price * qty;
                        newItem.find('.subtotal').val(subtotal.toFixed(2));
                        newItem.find('.subtotal-display').val(formatRupiah(subtotal));

                        // Add item to container
                        $('#edit-detail-items').append(newItem);
                        editItemIndex = index + 1;
                    });

                    $('#editFakturModal').modal('show');
                } else {
                    alert('Error fetching faktur data');
                }
            },
            error: function() {
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
