@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                    {{-- Production Report Dashboard --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Performance Report</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Speed Performance</strong>
                                            </p>
                                            <div class="chart">
                                                <canvas id="speedChart" height="180"style="height: 180px;"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Performance Indicator</strong>
                                            </p>
                                            <div class="progress-group">
                                                Performance
                                                <span class="float-right" id="performance_id">{{$indicator['performance']}} %</span>
                                                <div class="progress progress-sm" id="performance_bar">
                                                    <div class="progress-bar bg-primary" style="width: {{$indicator['performance']}}%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                Availability
                                                <span class="float-right" id="availability_id">{{$indicator['availability']}} %</span>
                                                <div class="progress progress-sm" id="availability_bar">
                                                    <div class="progress-bar bg-danger" style="width: {{$indicator['availability']}}%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                Quality
                                                <span class="float-right" id="quality_id">{{$indicator['quality']}} %</span>
                                                <div class="progress progress-sm" id="quality_bar">
                                                    <div class="progress-bar bg-success" style="width: {{$indicator['quality']}}%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                Overall Equipment Effectiveness
                                                <span class="float-right" id="oee_id">{{$indicator['oee']}} %</span>
                                                <div class="progress progress-sm" id="oee_bar">
                                                    <div class="progress-bar bg-warning" style="width: {{$indicator['oee']}}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-center">
                                                <strong>Waste Downtime</strong>
                                            </p>
                                            <div class="chart">
                                                <canvas id="wasteDtChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-center">
                                                <strong>Management Downtime</strong>
                                            </p>
                                            <div class="chart">
                                                <canvas id="managementDtChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class=" col-sm-4 col-4">
                                            <div class="description-block border-right">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="description-text float-left">Workorder: {{$workorder->wo_number}}</span><br>
                                                        <span class="description-text float-left">Machine: {{$workorder->machine->name}}</span><br>  
                                                        <span class="description-text float-left">Processed By: {{$user_involved['processed_by']}}</span><br>
                                                        <span class="description-text float-left">Start: {{$workorder->process_start}}</span><br>  
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="description-text float-left">Status: {{$workorder->status_wo}}</span><br>
                                                        <span class="description-text float-left">Chamfer: {{$workorder->chamfer}}</span><br>  
                                                        <span class="description-text float-left">Color: {{$color}}</span><br>
                                                        <span class="description-text float-left">End: {{$workorder->process_end}}</span><br>  
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="description-text float-left">Remarks: {{$workorder->remarks}}</span><br>
                                                    </div>
                                                </div>
                                                <a href="#" id="workorder-details" class="descriprion-text">See More</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-4">
                                            <div class="description-block border-right">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="description-text">TOTAL PRODUCTION</span>
                                                        <h5 class="description-header">{{$reports['production_count']}}</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="description-text">PLANNED PRODUCTION</span>
                                                        <h5 class="description-header">{{$reports['production_plan']}} Pcs</h5>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="description-text text-success">GOOD PRODUCT</span>
                                                        <h5 class="description-header">{{$reports['total_good_product']}}</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="description-text text-danger">BAD PRODUCT</span>
                                                        <h5 class="description-header">{{$reports['total_bad_product']}}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-4">
                                            <div class="description-block">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="description-text">PROCESS DURATION</span>
                                                        <h5 class="description-header">{{$reports['planned_time']}} min</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="description-text">TOTAL DOWNTIME</span>
                                                        <h5 class="description-header">{{$reports['total_downtime']}}</h5>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span class="description-text text-success">MANAGEMENT</span>
                                                        <h5 class="description-header">{{$reports['management_downtime']}}</h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="description-text text-danger">WASTE</span>
                                                        <h5 class="description-header">{{$reports['waste_downtime']}}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Production Report Column --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Production Report 
                                    @if (($workorder->bb_qty_bundle - count($productions)) == 0)
                                        (<i class="fas fa-check text-success"></i>)
                                    @endif
                                    </h5> 
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                @if (($workorder->bb_qty_bundle - count($productions)) == 0)
                                    <div class="card-body box-profile">
                                        <label for="">Report per Bundle</label>
                                        <ul class="nav nav-pills">
                                            @for ($i = 1; $i < $workorder->bb_qty_bundle+1; $i++)
                                                <li class="nav-item">
                                                    <a class="btn btn-transparent smelting-number 
                                                        @foreach ($productions as $prod)
                                                            @if($i != $prod->bundle_num)
                                                                @continue
                                                            @endif
                                                            bg-primary
                                                        @endforeach
                                                        "
                                                        href="#" style="margin:1px;"
                                                        id="{{$i}}"
                                                        data-toggle="tab">{{ $i }}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Downtime Report --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card direct-chat card-primary card-outline direct-chat-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Downtime Report 
                                        <?php $remarkEmpty = true; ?>
                                        @foreach ($downtimes as $downtime)
                                            @if ($downtime->is_remark_filled == false)
                                                <?php $remarkEmpty = true; ?>
                                                @break;
                                            @endif
                                            <?php $remarkEmpty = false; ?>
                                        @endforeach
                                        @if (count($downtimes) == 0)
                                            <?php $remarkEmpty = false ?>
                                        @endif
                                        @if ($remarkEmpty == false)
                                            (<i class="fas fa-check text-success"></i>)
                                        @endif
                                        <?php $remarkEmpty = true; ?>
                                        
                                    </h3>
                                    <div class="card-tools">
                                        <span id="downtime-list-count" class="badge badge-danger"></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="direct-chat-messages"  style="height: 500px;">
                                        <div class="direct-chat-msg">
                                            <div class="col-12" id="downtime-list">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        updateDowntimeList();
        updateSpeedChart();
        updateDowntimeChart();
    });

    function updateSpeedChart()
    {
        $('.speed-chart').show();
        $.ajax({
            method:'GET',
            url:'{{route('workorder.speedChart')}}',
            data:{
                workorder : '{{$workorder->id}}',
            },
            dataType:'json',
            success:function(response){
                var areaChartCanvas = $('#speedChart').get(0).getContext('2d');

                var areaChartData = {
                    labels  : response['created_at'],
                    datasets: [
                        {
                        label               : 'Production Speed',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : response['speed']
                        },
                    ]
                }

                var areaChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }]
                    }
                }

                // This will get the first returned node in the jQuery collection.
                new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaChartData,
                    options: areaChartOptions
                })

                $('.speed-chart').hide();
            },
        });
    }

    function updateDowntimeChart()
    {
        //Waste Downtime
        $.ajax({
          url:'{{route('downtime.getDowntimeWasteChart')}}',
          type:'POST',
          dataType: 'json',
          data:{
            workorder_id: '{{$workorder->id}}',
            is_waste_downtime : true,
            _token: '{{csrf_token()}}',
          },
          success:function(response)
          {
            var labelList = [];
            response.data.forEach(element => {
                if(!element.reason)
                {
                    return;
                }
                labelList.push(element.reason);
            });
            var uniqueLabelList = [];
            for(i=0; i < labelList.length; i++){
                if(uniqueLabelList.indexOf(labelList[i]) === -1) {
                    uniqueLabelList.push(labelList[i]);
                }
            }
            var dataList = [];
            response.data.forEach(element => {
                if(!element.total_duration)
                {
                    return;
                }
                dataList.push(element.total_duration);
            });
            var uniqueDataList = [];
            for(i=0; i < dataList.length; i++){
                if(uniqueDataList.indexOf(dataList[i]) === -1) {
                    uniqueDataList.push(dataList[i]);
                }
            }
            var areaChartData = {
                labels  : uniqueLabelList,
                datasets: [
                    {
                    label               : 'Waste Downtime',
                    barThickness        : 75,
                    backgroundColor     : 'rgb(230, 0, 0)',
                    borderColor         : 'rgb(230, 0, 0)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : uniqueDataList
                    },
                ]
            }
            var areaChartOptions = {
                maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines : {
                                display : false,
                            },
                            ticks: {
                                beginAtZero: true,  // minimum value will be 0.
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                                display : true,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Seconds'
                            },
                            ticks: {
                                beginAtZero: true,   // minimum value will be 0.
                                steps: 1,
                                stepValue: 1,
                            }
                        }]
                    }
            }
            var barChartCanvas = $('#wasteDtChart').get(0).getContext('2d');
            var barChartData = $.extend(true, {}, areaChartData);
            var barChartOptions = areaChartOptions;
            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
          },
        });

        //Management Downtime
        $.ajax({
          url:'{{route('downtime.getDowntimeManagementChart')}}',
          type:'POST',
          dataType: 'json',
          data:{
            workorder_id: '{{$workorder->id}}',
            is_waste_downtime : false,
            _token: '{{csrf_token()}}',
          },
          success:function(response)
          {
            var labelList = [];
            response.data.forEach(element => {
                if(!element.reason)
                {
                    return;
                }
                labelList.push(element.reason);
            });
            var uniqueLabelList = [];
            for(i=0; i < labelList.length; i++){
                if(uniqueLabelList.indexOf(labelList[i]) === -1) {
                    uniqueLabelList.push(labelList[i]);
                }
            }
            var dataList = [];
            response.data.forEach(element => {
                if(!element.total_duration)
                {
                    return;
                }
                dataList.push(element.total_duration);
            });
            var uniqueDataList = [];
            for(i=0; i < dataList.length; i++){
                if(uniqueDataList.indexOf(dataList[i]) === -1) {
                    uniqueDataList.push(dataList[i]);
                }
            }
            var areaChartData = {
                labels  : uniqueLabelList,
                datasets: [
                    {
                    label               : 'Management Downtime',
                    barThickness        : 75,
                    backgroundColor     : 'rgb(51, 153, 0)',
                    borderColor         : 'rgb(51, 153, 0)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : uniqueDataList
                    },
                ]
            }
            var areaChartOptions = {
                maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines : {
                                display : false,
                            },
                            ticks: {
                                beginAtZero: true,   // minimum value will be 0.
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                                display : true,
                            },
                            ticks: {
                                beginAtZero: true,   // minimum value will be 0.
                                steps: 1,
                                stepValue: 1,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Seconds'
                            },
                        }]
                    }
            }
            var barChartCanvas = $('#managementDtChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var barChartOptions = areaChartOptions;
            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

          },
          
        });
    }

    function updateDowntimeList()
    {
        $.ajax({
          url:'{{route('downtime.updateDowntime')}}',
          type:'POST',
          dataType: 'json',
          data:{
            workorder_id: '{{$workorder->id}}',
            _token: '{{csrf_token()}}',
          },
          success:function(response){
            $('#downtime-list-count').html(response.data.length);
            var data = response.data;
            var downtimeList = '';
            for (let index = 0; index < data.length; index++) {
                var isWasteDowntime = data[index].is_waste_downtime;
                var downtimeReason = data[index].downtime_reason;
                var istextRed = '';

                if(isWasteDowntime){
                    isWasteDowntime = 'Waste Downtime';
                    istextRed = 'text-danger';
                }else{
                    isWasteDowntime = 'Management Downtime';
                }

                var downtimeNumber = data[index].downtime_number;
                var cardOpeningDiv = '<div class="card card-warning collapsed-card">';
                var dtTime = '<h3 class="card-title">' + data[index].start_time + ' - '+ data[index].end_time +'</h3>';
                var downtimeListBody = '</div>';
                                    
                
                if(data[index].end_time == null){
                    cardOpeningDiv = '<div class="card card-danger collapsed-card">';
                    dtTime = '<h3 class="card-title">' + data[index].start_time + ' - Now</h3>';
                    downtimeListBody = '';
                }
                if(data[index].is_remark_filled == true){
                    cardOpeningDiv = '<div class="card card-success collapsed-card">';
                    dtTime = '<h3 class="card-title"> <b class="'+istextRed+'">'+isWasteDowntime+'</b> | ' + data[index].start_time + ' - '+ data[index].end_time +' | ' + data[index].duration + ' | '+ data[index].downtime_reason +' | '+ data[index].remarks +'</h3>';
                    downtimeListBody = '</div>' +
                                    '<div id="downtime-reason-'+downtimeNumber+'" reason="'+downtimeReason+'" isWasteDowntime="'+data[index].is_waste_downtime+'"></div>';
                                    
                }
                
                downtimeList += cardOpeningDiv +
                    '<div class="card-header">'+
                        dtTime +
                        downtimeListBody +
                    '</div>' +
                '</div>';
            }
            $('#downtime-list').html(downtimeList);
          },
        });
    }

    $('#workorder-details').on('click',function()
    {
        Swal.fire({
            title: '<strong>Machine {{$workorder->machine->name}} - {{$workorder->wo_number}} ({{$workorder->status_wo}})</strong>',
            html:
            '<div class="row">' +
                '<div class="col-1">' +
                '</div>'+
                '<div class="col-5">' +
                    '<div class="description-block border-right">' +
                        '<span class="description-text float-left">Created By: {{$user_involved['created_by']}}</span><br>' +
                        '<span class="description-text float-left">Created at: {{$workorder->created_at}}</span><br>' +
                        '<span class="description-text float-left">Edited By: {{$user_involved['edited_by']}}</span><br>' +
                        '<span class="description-text float-left">Updated at: {{$workorder->updated_at}}</span><br>' +
                        '<hr>' +
                        '<span class="description-text float-left">Processed By: {{$user_involved['processed_by']}}</span><br>' +
                        '<span class="description-text float-left">Process Start: {{$workorder->process_start}}</span><br>' +  
                        '<span class="description-text float-left">Process End: {{$workorder->process_end}}</span><br>' +  
                        '<hr>' +
                        '<span class="description-text float-left">Supplier: {{$workorder->bb_supplier}}</span><br>' +
                        '<span class="description-text float-left">Grade: {{$workorder->bb_grade}}</span><br>' +
                        '<span class="description-text float-left">Diameter: {{$workorder->bb_diameter}} mm</span><br>' +
                        '<span class="description-text float-left">Qty (Kg): {{$workorder->bb_qty_pcs}} Kg</span><br>' +
                        '<span class="description-text float-left">Qty (Coil): {{$workorder->bb_qty_coil}} Coil</span><br>' +
                        '<span class="description-text float-left">Qty (Bundle): {{$workorder->bb_qty_bundle}} Bundle</span><br>' +
                    '</div>'+
                '</div>'+
                '<div class="col-5">' +
                    '<div class="description-block">' +
                        '<span class="description-text float-left">Customer: {{$workorder->fg_customer}}</span><br>' +
                        '<span class="description-text float-left">Straightness Standard: {{$workorder->straightness_standard}}</span><br>' +
                        '<span class="description-text float-left">Size: {{$workorder->fg_size_1}} mm x {{$workorder->fg_size_2}} mm</span><br>' +
                        '<span class="description-text float-left">Tolerance: {{$workorder->tolerance_minus}} mm, {{$workorder->tolerance_plus}} mm</span><br>' +
                        '<span class="description-text float-left">Reduction rate: {{$workorder->fg_reduction_rate}} %</span><br>' +
                        '<span class="description-text float-left">Shape: {{$workorder->fg_shape}}</span><br>' +
                        '<span class="description-text float-left">QTY per Bundle (Kg): {{$workorder->fg_qty_kg}} Kg</span><br>' +
                        '<span class="description-text float-left">QTY per Bundle (Pcs): {{$workorder->fg_qty_pcs}} Pcs</span><br>' +
                        '<span class="description-text float-left">Chamfer: {{$workorder->chamfer}}</span><br>' +
                        '<span class="description-text float-left">Color: {{$color}}</span><br>' +
                        '<hr>' +
                        '<span class="description-text float-left">Remarks: {{$workorder->remarks}}</span><br>' +
                    '</div>'+
                '</div>'+
                '<div class="col-1">' +
                '</div>'+
            '</div>'+
            '<div class="row" >' + 
                '<div class="col-sm-8">' +
                '</div>' +
                '<div class="col-sm-3">' + 
                    '<a href="' + window.location.origin + '/workorder/{{$workorder->id}}/export" class="btn btn-success" target"_blank">Export to Excel</a>' + 
                '</div>' + 
                '<div class="col-sm-1">' +
                '</div>' +
            '</div>',
            width: '1200px',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:'Close',
            confirmButtonAriaLabel: 'Thumbs up, great!',
        });
    });

    $('#print-label').on('click', function()
    {
        event.preventDefault();
        window.open("{{ url('/report/' . $workorder->id . '/printToPdf') }}");
    });

    $('a.smelting-number').on('click',function(event)
    {
        $.ajax({
            url:'{{route('production.getProductionInfo')}}',
            type:'POST',
            dataType:'json',
            data:{
                bundle_num:event.currentTarget.id,
                workorder_id:'{{$workorder->id}}',
                _token:'{{csrf_token()}}'
            },
            success:function(response){
                var bundle_judgement = 'Not Good';
                if(response['bundle_judgement']==1){bundle_judgement='Good'}
                var visual = 'Not Good';
                Swal.fire({
                    title: '<strong>Bundle No . ' + response['bundle_num'] + '</strong>',
                    html:
                    '<div class="row">' +
                        '<div class="col-1">' +
                        '</div>'+
                        '<div class="col-5">' +
                            '<div class="description-block border-right">' +
                                '<span class="description-text float-left">Dies No. : '+response['dies_num']+'</span><br>' +
                                '<hr>' +
                                '<span class="description-text float-left">Coil No. : '+response['coil_num']+'</span><br>' +
                                '<span class="description-text float-left">Weight   : '+response['coil_weight']+' Kg</span><br>' +
                                '<span class="description-text float-left">No. Leburan   : '+response['coil_smelting_num']+'</span><br>' +
                                '<span class="description-text float-left">Area  : '+response['coil_area']+'</span><br>' +
                                '<hr>' +
                                '<span class="description-text float-left">Diameter Ujung: '+response['diameter_ujung']+' mm</span><br>' +
                                '<span class="description-text float-left">Diameter Tengah: '+response['diameter_tengah']+' mm</span><br>' +
                                '<span class="description-text float-left">Diameter Ekor: '+response['diameter_ekor']+' mm</span><br>' +
                                '<span class="description-text float-left">Kelurusan Aktual: '+response['kelurusan_aktual']+'</span><br>' +
                                '<span class="description-text float-left">Panjang Aktual: '+response['panjang_aktual']+' mm</span><br>' +
                                '<hr>' +
                                '<span class="description-text float-left">Berat FG: '+response['berat_fg']+' mm</span><br>' +
                                '<span class="description-text float-left">QTY (Pcs): '+response['pcs_per_bundle']+' Pcs</span><br>' +
                            '</div>'+
                        '</div>'+
                        '<div class="col-5">' +
                            '<div class="description-block">' +
                                '<span class="description-text float-left">Judgement: '+bundle_judgement+'</span><br>' +
                                '<span class="description-text float-left">Visual: '+response['visual']+'</span><br>' +
                                '<hr>' +
                                '<span class="description-text float-left">Created By: '+response['created_by']+'</span><br>' +
                                '<span class="description-text float-left">Created At: '+response['created_at']+'</span><br>' +
                                '<span class="description-text float-left">Edited By: '+response['edited_by']+'</span><br>' +
                                '<span class="description-text float-left">Updated At: '+response['updated_at']+'</span><br>' +
                            '</div>'+
                        '</div>'+
                        '<div class="col-1">' +
                        '</div>'+
                    '</div>'+
                    '<div class="row" >' + 
                        '<div class="col-sm-8">' +
                        '</div>' +
                        '<div class="col-sm-3">' + 
                            '<a href="' + window.location.origin + '/report/' + response['id'] + '/printToPdf" class="btn btn-success" target"_blank">Print</a>' + 
                        '</div>' + 
                        '<div class="col-sm-1">' +
                        '</div>' +
                    '</div>',
                    padding:'10px',
                    width: '1000px',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:'OK',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                });
            },
            error:function(response)
            {
                console.log(response.responseText);
            }
        });
    });

</script>
@endpush
