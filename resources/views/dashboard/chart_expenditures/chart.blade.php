        <div class="card">
            <div class="card-header">
                <h4>Kas Pengeluaran</h4>
            </div>
            <div class="card-body">
                <div id="cash-transaction-expenditure-chart-dashboard"></div>
            </div>
        </div>

@push('js')
@include('dashboard.chart_expenditures.script')
@endpush