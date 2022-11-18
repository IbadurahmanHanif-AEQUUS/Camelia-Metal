@extends('templates.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Result</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Runtime (min)</span>
                                            <span class="info-box-number text-center text-muted mb-0" id="total_runtime">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Downtime (min)</span>
                                            <span class="info-box-number text-center text-muted mb-0" id="total_downtime">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Pcs (Pcs)</span>
                                            <span class="info-box-number text-center text-muted mb-0" id="total_pcs">0</span>
                                            <span class="text-left text-muted mb-0" id="total_pcs_good">Good: 0</span>
                                            <span class="text-left text-muted mb-0" id="total_pcs_bad">Bad: 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Weight FG (Kg)</span>
                                            <span class="info-box-number text-center text-muted mb-0" id="total_weight_fg">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Weight BB (Kg)</span>
                                            <span class="info-box-number text-center text-muted mb-0" id="total_weight_bb">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Weight Loss (Kg)</span>
                                            <span class="info-box-number text-center text-muted mb-0" id="total_weight_loss">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>   
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Summary Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="search-form" class="form-inline" role="form">
                                @csrf
                                <div class="form-group">
                                    <label style="padding-right: 10px ">Search Data From : </label>
                                    <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                        <input name="report_date_1" type="text" class="form-control datetimepicker-input @error('report_date_1') is-invalid @enderror" data-target="#reservationdatetime1" value="{{old('report_date_1')}}"/>
                                        <div class="input-group-append" data-target="#reservationdatetime1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="padding-left: 10px; padding-right: 10px "> To : </label>
                                    <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                        <input name="report_date_2" type="text" class="form-control datetimepicker-input @error('report_date_2') is-invalid @enderror" data-target="#reservationdatetime2" value="{{old('report_date_2')}}"/>
                                        <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <button style="margin-left: 10px;" type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <br><br>
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Wo Number</th>
                                        <th>Total Runtime</th>
                                        <th>Total Downtime</th>
                                        <th>Total Production (Pcs)</th>
                                        <th>Total Good (Pcs)</th>
                                        <th>Total Bad (Pcs)</th>
                                        <th>Total Weight FG</th>
                                        <th>Total Weight BB</th>
                                        <th>Total Weight Loss</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> 
                    </div>          
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->   
@endsection

@push('scripts')
<script>
    $(function(){
        $('#reservationdatetime1').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });
        $('#reservationdatetime2').datetimepicker({ 
            format: 'YYYY-MM-DD',
        });

    });
</script>
<script>
    var oTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{route('dailyReport.getCustomFilterData')}}',
            data: function (d) {
                d.report_date_1 = $('input[name=report_date_1]').val();
                d.report_date_2 = $('input[name=report_date_2]').val();
            }
        },
        columns: [
            {data:'DT_RowIndex',orderable:false, searchable:false},
            {data: 'wo_number'},
            {data: 'total_runtime'},
            {data: 'total_downtime'},
            {data: 'total_pcs'},
            {data: 'total_pcs_good'},
            {data: 'total_pcs_bad'},
            {data: 'total_weight_fg'},
            {data: 'total_weight_bb'},
            {data: 'weight_loss'},
        ],
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        oTable.draw();
        calculateSearch();
    });

    function calculateSearch(){
        $.ajax({
            method:'POST',
            url:'{{route('dailyReport.calculateSearchResult')}}',
            data: {
                report_date_1: $('input[name=report_date_1]').val(),
                report_date_2: $('input[name=report_date_2]').val(),
                _token: '{{csrf_token()}}'
            },
            dataType:'json',
            success:function(response){
                console.log(response);
                $('#total_runtime').html(response.total_runtime);
                $('#total_downtime').html(response.total_downtime);
                $('#total_pcs').html(response.total_pcs);
                $('#total_pcs_good').html("Good: " + response.total_pcs_good);
                $('#total_pcs_bad').html("Bad: " + response.total_pcs_bad);
                $('#total_weight_fg').html(response.total_weight_fg);
                $('#total_weight_bb').html(response.total_weight_bb);
                $('#total_weight_loss').html(response.total_weight_loss);
            }
        });
    }
</script>
@endpush