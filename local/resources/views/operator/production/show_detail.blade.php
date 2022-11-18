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
                                                <strong>Current Speed Performance</strong>
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
                                @else
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
                                        <div class="dropdown-divider"></div>
                                        <form id="production-report" action="" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Coil Number</label>
                                                <select name="coil-num"
                                                    class="form-control @error('coil-num') is-invalid @enderror">
                                                    <option value="">-- Select Coil Number --</option>
                                                    @foreach ($smeltings as $smelt)
                                                        <option value="{{ $smelt->id }}">Coil Num : {{ $smelt->coil_num }} - No. Leburan : {{($smelt->smelting_num)}} - Berat : {{$smelt->weight}} Kg</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Bundle Number</label>
                                                <?php $skip = false; ?>
                                                <select name="bundle-num"
                                                    class="form-control @error('bundle-num') is-invalid @enderror">
                                                    @for ($i = 1; $i < $workorder->bb_qty_bundle + 1; $i++)
                                                        @foreach ($productions as $prod)
                                                            @if ($prod->bundle_num == $i)
                                                                <?php $skip = true; ?>
                                                                {{$prod->bundle_num}}
                                                                @break
                                                            @endif
                                                        @endforeach
                                                        @if ($skip == false)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                            @break
                                                        @endif
                                                        <?php $skip = false; ?>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <div class="row">
                                                <input hidden name="workorder_id" type="text"
                                                class="form-control @error('workorder_id') is-invalid @enderror"
                                                placeholder="No. Leburan"
                                                value="{{ $workorder->id ?? old('workorder_id') }}">
                                                <div class="col-6">
                                                    
                                                    <div class="form-group">
                                                        <label for="">Dies Number</label>
                                                        <input type="text" name="dies-number"
                                                            class="form-control @error('dies-number') is-invalid @enderror"
                                                            placeholder="Dies Number" value="{{ old('dies-number') }}">
                                                        @error('dies-number')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Diameter Ujung (mm)</label>
                                                        <input type="text" name="diameter-ujung"
                                                            class="form-control @error('diameter-ujung') is-invalid @enderror"
                                                            placeholder="Diameter Ujung"
                                                            value="{{ old('diameter-ujung') }}">
                                                        @error('diameter-ujung')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Diameter Tengah (mm)</label>
                                                        <input type="text" name="diameter-tengah"
                                                            class="form-control @error('diameter-tengah') is-invalid @enderror"
                                                            placeholder="Diameter Tengah"
                                                            value="{{ old('diameter-tengah') }}">
                                                        @error('diameter-tengah')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Diameter Ekor (mm)</label>
                                                        <input type="text" name="diameter-ekor"
                                                            class="form-control @error('diameter-ekor') is-invalid @enderror"
                                                            placeholder="Diameter Ekor"
                                                            value="{{ old('diameter-ekor') }}">
                                                        @error('diameter-ekor')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Kelurusan Aktual</label>
                                                        <input type="text" name="kelurusan-aktual"
                                                            class="form-control @error('kelurusan-aktual') is-invalid @enderror"
                                                            placeholder="Kelurusan Aktual"
                                                            value="{{ old('kelurusan-aktual') }}">
                                                        @error('kelurusan-aktual')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Panjang Aktual (mm)</label>
                                                        <input type="text" name="panjang-aktual"
                                                            class="form-control @error('panjang-aktual') is-invalid @enderror"
                                                            placeholder="Panjang Aktual"
                                                            value="{{ old('panjang-aktual') }}">
                                                        @error('panjang-aktual')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Berat Finish Good (Kg)</label>
                                                        <input type="text" name="berat-fg"
                                                            class="form-control @error('berat-fg') is-invalid @enderror"
                                                            placeholder="Berat Finish Good"
                                                            value="{{ old('berat-fg') }}">
                                                        @error('berat-fg')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Pcs per Bundle (Pcs)</label>
                                                        <input type="text" name="pcs-per-bundle"
                                                            class="form-control @error('pcs-per-bundle') is-invalid @enderror"
                                                            placeholder="Pcs Per Bundle"
                                                            value="{{ old('pcs-per-bundle') }}">
                                                        @error('pcs-per-bundle')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Bundle Judgement</label>
                                                        <select name="bundle-judgement" id="judgement-select" class="form-control @error('bundle-judgement') is-invalid @enderror">
                                                            <option value="">-- Select Judgement --</option>
                                                            <option value="1">Good</option>
                                                            <option value="0">Not Good</option>
                                                        </select>
                                                        @error('bundle-judgement')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Visual</label>
                                                        <select name="visual" id="visual-options"
                                                            class="form-control @error('visual') is-invalid @enderror">
                                                            <option value="">-- Select Judgement --</option>
                                                        </select>
                                                        @error('visual')
                                                            <span class="text-danger help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <button class="form-control btn btn-primary" style="margin-left:200px;">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

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

                    {{-- Approval Button --}}
                    <?php $allProductionDataComplete = false ?>
                    <?php $allDowntimeDataComplete = false ?>
                    @if (($workorder->bb_qty_bundle - count($productions)) == 0)
                        <?php $allProductionDataComplete = true ?>
                    @endif
                    <?php $checkRemarkEmpty = true; ?>
                    @foreach ($downtimes as $downtime)
                        @if ($downtime->is_remark_filled == false && $downtime->is_downtime_stopped == true)
                            <?php $checkRemarkEmpty = true; ?>
                            @break;
                        @endif
                        <?php $checkRemarkEmpty = false; ?>
                    @endforeach
                    @if (count($downtimes) == 0)
                        <?php $allDowntimeDataComplete = true ?>
                    @endif
                    @if ($checkRemarkEmpty == false)
                        <?php $allDowntimeDataComplete = true ?>
                    @endif
                    <?php $checkRemarkEmpty = true; ?>

                    <?php $downtimeDataPending = false ?>
                    @foreach ($downtimes as $downtime)
                        @if ($downtime->is_remark_filled == false && $downtime->is_downtime_stopped == false)
                            <?php $downtimeDataPending = true; ?>
                            @break;
                        @endif
                        <?php $downtimeDataPending = false; ?>
                    @endforeach

                    <div class="row">
                        <div class="col-4">
                            <div class="card card-outline card-primary">
                                <div class="card-header" id="div_str_finish">
                                    Finish Workorder Button
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <form action="" method="POST" id="finishForm">
                                            @csrf
                                            <input type="submit" value="Process" style="display:none">
                                            @if ($allProductionDataComplete == false || $allDowntimeDataComplete == false)
                                                <p class="text-danger">Please Finish All Report First</p>
                                            @elseif ($downtimeDataPending == true)
                                                <p class="">There is a downtime that still running. Do you want to force it done?</p>
                                                <p class="text-danger">Note: This downtime will be deleted</p>
                                                <a href="{{url('/operator/production/'.$workorder->id.'/finishWithDelete')}}" class="btn btn-success finish-button">Finish Workorder</a>
                                            @else
                                                <a href="{{url('/operator/production/'.$workorder->id.'/finish')}}" class="btn btn-success finish-button">Finish Workorder</a>
                                            @endif
                                        </form>
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

    let aChannel = Echo.channel('channel-downtime');
    aChannel.listen('DowntimeCaptured', function(data)
    {
        if (data.downtime.status == 'stop') {
            Swal.fire({
                icon: 'info',
                title: 'Downtime Captured',
                showConfirmButton: false,
                timer: 3000
            });
        }
        updateDowntimeList();
    });

    let productionChannel = Echo.channel('channel-production-graph');
    productionChannel.listen('productionGraph',function(data){
        updateSpeedChart();
    });

    $('a.finish-button').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure want to finish this workorder?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, finish it!'
            }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('finishForm').action=href;
                document.getElementById('finishForm').submit();
            }
        })
    });
	
    function updateSpeedChart()
    {
        $('.speed-chart').show();
        $.ajax({
            method:'GET',
            url:'{{route('production.speedChart')}}',
            data:{
                workorder:'{{$workorder->id}}'
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
            }
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
                var downtimeListBody = '<div class="card-tools">' +
                                            '<button type="button" class="btn btn-tool"data-card-widget="collapse"><i class="fas fa-plus"></i></button>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="card-body">' +
                                        '<div class="col-12">' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Category</label>' +
                                                '<select onchange="updateReason(' + downtimeNumber + ')" name="dt-category-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled>-- Select Downtime Category --</option>' +
                                                    '<option value="management">Management Downtime</option>' +
                                                    '<option value="waste">Waste Downtime</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Reason</label>' +
                                                '<select name="dt-reason-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled>-- Select Reason --</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Remarks</label>' +
                                                '<textarea name="dt-remarks-' + downtimeNumber + '" class="form-control"></textarea>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<div class="row">' +
                                                    '<div class="col-1">' +
                                                        '<button class="btn btn-primary" onClick="storeDowntimeReason(' + downtimeNumber + ')">Apply</button>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' ;
                
                if(data[index].end_time == null){
                    cardOpeningDiv = '<div class="card card-danger collapsed-card">';
                    dtTime = '<h3 class="card-title">' + data[index].start_time + ' - Now</h3>';
                    downtimeListBody = '';
                }
                if(data[index].is_remark_filled == true){
                    cardOpeningDiv = '<div class="card card-success collapsed-card">';
                    dtTime = '<h3 class="card-title"> <b class="'+istextRed+'">'+isWasteDowntime+'</b> | ' + data[index].start_time + ' - '+ data[index].end_time +' | ' + data[index].duration + ' | '+ data[index].downtime_reason +' | '+ data[index].remarks +'</h3>';
                    downtimeListBody = '<div class="card-tools">' +
                                            '<button type="button" class="btn btn-tool"data-card-widget="collapse"><i class="fas fa-plus"></i></button>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div id="downtime-reason-'+downtimeNumber+'" reason="'+downtimeReason+'" isWasteDowntime="'+data[index].is_waste_downtime+'"></div>' + 
                                    '<div class="card-body">' +
                                        '<div class="col-12">' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Category</label>' +
                                                '<select onchange="updateReason('+downtimeNumber+')" name="dt-category-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled>-- Select Downtime Category --</option>' +
                                                    '<option value="management" '+checkWasteDowntime(data[index].is_waste_downtime)+'>Management Downtime</option>' +
                                                    '<option value="waste" '+checkWasteDowntime(data[index].is_waste_downtime)+'>Waste Downtime</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Downtime Reason</label>' +
                                                '<select name="dt-reason-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled selected>-- Select Reason --</option>' +
                                                '</select>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<label for="">Remarks</label>' +
                                                '<textarea name="dt-remarks-' + downtimeNumber + '" class="form-control">' + data[index].remarks + '</textarea>' +
                                            '</div>' +
                                            '<div class="form-group">' +
                                                '<div class="row">' +
                                                    '<div class="col-1">' +
                                                        '<button class="btn btn-primary" onClick="storeDowntimeReason(' + downtimeNumber + ')">Apply</button>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' ;
                }
                
                downtimeList += cardOpeningDiv +
                    '<div class="card-header">'+
                        dtTime +
                        downtimeListBody +
                    '</div>' +
                '</div>';
            }
            $('#downtime-list').html(downtimeList);

            for (let index = 0; index < data.length; index++) {
                var downtimeNumber = data[index].downtime_number;
                updateReason(downtimeNumber);
            }
          },
        });
    }

    function storeDowntimeReason(downtime_number)
    {
        var downtimeCategory = $('select[name="dt-category-'+downtime_number+'"]').val();
        var downtimeReason = $('select[name="dt-reason-'+downtime_number+'"]').val();
        var downtimeRemarks = $('textarea[name="dt-remarks-'+downtime_number+'"]').val();
        $.ajax({
            url:'{{route('downtimeRemark.submit')}}',
            type:'POST',
            dataType:'json',
            data:{
                _token: '{{csrf_token()}}', 
                downtimeNumber: downtime_number,
                downtimeCategory: downtimeCategory,
                downtimeReason: downtimeReason,
                downtimeRemarks: downtimeRemarks,
            },
            success:function(response){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Success',
                    text: 'Data Updated Successfully',
                    showConfirmButton: false,
                    timer: 3000
                });
                location.reload();
            },
            error:function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Data Uncomplete',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        })
    }

    function updateReason(downtime_number)
    {
        var downtimeCategory = $('[name="dt-category-'+downtime_number+'"]').val();
            if (downtimeCategory == 'management') {
                $("[name='dt-reason-"+downtime_number+"']").html(
                    '<option value="" disabled>-- Select Reason --</option>' +
                    '<option value="Briefing" '+ checkReason('Briefing',downtime_number) +'>Briefing</option>' +
                    '<option value="Check Shot Blast" '+ checkReason('Check Shot Blast',downtime_number) +'>Cek Shot Blast</option>' +
                    '<option value="Cek Mesin" '+ checkReason('Cek Mesin',downtime_number) +'>Cek Mesin</option>' +
                    '<option value="Pointing / Roll / Bubble" '+ checkReason('Pointing / Roll / Bubble',downtime_number) +'>Pointing / Roll / Bubble</option>' +
                    '<option value="Setting Awal" '+ checkReason('Setting Awal',downtime_number) +'>Setting Awal</option>' +
                    '<option value="Selesai Satu" '+ checkReason('Selesai Satu',downtime_number) +'>Selesai Satu</option>' +
                    '<option value="Bersih-bersih Area" '+ checkReason('Bersih-bersih Area',downtime_number) +'>Bersih-bersih Area</option>' +
                    '<option value="Preventive Maintenance" '+ checkReason('Preventive Maintenance',downtime_number) +'>Preventive Maintenance</option>' + 
                    '<option value="Lain-lain" '+ checkReason('Lain-lain',downtime_number) +'>Lain-lain</option>'
                );
            }
            
            if (downtimeCategory == 'waste') {
                $("[name='dt-reason-"+downtime_number+"']").html(
                    '<option value="" disabled>-- Select Reason --</option>' +
                    '<option value="Bongkar Pasang" '+ checkReason('Bongkar Pasang',downtime_number) +'>Bongkar Pasang</option>' +
                    '<option value="Tunggu Bahan" '+ checkReason('Tunggu Bahan',downtime_number) +'>Tunggu Bahan</option>' +
                    '<option value="Ganti Bahan" '+ checkReason('Ganti Bahan',downtime_number) +'>Ganti Bahan</option>' +
                    '<option value="Tunggu Dies" '+ checkReason('Tunggu Dies',downtime_number) +'>Tunggu Dies</option>' +
                    '<option value="Gosok Dies" '+ checkReason('Gosok Dies',downtime_number) +'>Gosok Dies</option>' +
                    '<option value="Ganti Part Shot Blast" '+ checkReason('Ganti Part Shot Blast',downtime_number)+'>Ganti Part Shot Blast</option>' +
                    '<option value="Putus Dies" '+ checkReason('Putus Dies',downtime_number) +'>Putus Dies</option>' +
                    '<option value="Setting Ulang" '+ checkReason('Setting Ulang',downtime_number) +'>Setting Ulang</option>' +
                    '<option value="Ganti Polishing" '+ checkReason('Ganti Polishing',downtime_number) +'>Ganti Polishing</option>' +
                    '<option value="Ganti Nozzle" '+ checkReason('Ganti Nozzle',downtime_number) +'>Ganti Nozzle</option>' +
                    '<option value="Ganti Roller" '+ checkReason('Ganti Roller',downtime_number) +'>Ganti Roller</option>' +
                    '<option value="Dies Rusak" '+ checkReason('Dies Rusak',downtime_number) +'>Dies Rusak</option>' +
                    '<option value="Trouble Mesin" '+ checkReason('Trouble Mesin',downtime_number) +'>Trouble Mesin</option>' +
                    '<option value="Validasi QC" '+ checkReason('Validasi QC',downtime_number) +'>Validasi QC</option>' +
                    '<option value="Mesin Trouble" '+ checkReason('Mesin Trouble',downtime_number) +'>Mesin Trouble</option>' +
                    '<option value="Tambahan Waktu Setting" '+ checkReason('Tambahan Waktu Setting',downtime_number) +'>Tambahan Waktu Setting</option>' +
                    '<option value="Lain-lain" '+ checkReason('Lain-lain',downtime_number) +'>Lain-lain</option>'
                );
            }
    }

    function checkReason(reason,downtimeNumber)
    {
        if(reason == $('#downtime-reason-'+downtimeNumber).attr('reason'))
        {
            return 'selected';
        }
        return '';
    }

    function checkWasteDowntime(isWasteDowntime)
    {
        if (isWasteDowntime) {
            return 'selected';
        }
        return '';
    }

    function storeData(data)
    {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ route('production.store') }}',
            data: {
                workorder_id: data.workorder_id,
                coil_num: data.coil_num,
                bundle_num: data.bundle_num,
                dies_num: data.dies_num,
                diameter_ujung: data.diameter_ujung,
                diameter_tengah: data.diameter_tengah,
                diameter_ekor: data.diameter_ekor,
                kelurusan_aktual: data.kelurusan_aktual,
                panjang_aktual: data.panjang_aktual,
                berat_fg: data.berat_fg,
                pcs_per_bundle: data.pcs_per_bundle,
                bundle_judgement: data.bundle_judgement,
                visual: data.visual,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Production report data has been submitted',
                    showConfirmButton: false,
                    timer: 2000
                });
                location.reload();
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Went Wrong',
                    html: '<b class="text-danger">' + JSON.parse(response.responseText)
                        .message + '</b> <br><br> <B>detail</b>: ' + response
                        .responseText,
                    showConfirmButton: false,
                    timer: 10000
                });
            }
        });
    };

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
                        '<span class="description-text float-left">Start: {{$workorder->process_start}}</span><br>' +  
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

    $("[name='bundle-num']").on('change', function(event)
    {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '{{ route('production.getSmeltingNum') }}',
            data: {
                workorder_id: '{{ $workorder->id }}',
                bundle_num: $("[name='bundle-num']").val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#smelting-num").html('No. Leburan: ' + response);
            }
        })
    });

    $('#production-report').on('submit', function(event)
    {
        event.preventDefault();
        var bundle_num = $("[name='bundle-num']").val();
        var coil_num = $("[name='coil-num']").val();
        var workorder_id = $("[name='workorder_id']").val();
        var dies_number = $("[name='dies-number']").val();
        var diameter_ujung = $("[name='diameter-ujung']").val();
        var diameter_tengah = $("[name='diameter-tengah']").val();
        var diameter_ekor = $("[name='diameter-ekor']").val();
        var kelurusan_aktual = $("[name='kelurusan-aktual']").val();
        var panjang_aktual = $("[name='panjang-aktual']").val();
        var berat_fg = $("[name='berat-fg']").val();
        var pcs_per_bundle = $("[name='pcs-per-bundle']").val();
        var bundle_judgement = $("[name='bundle-judgement']").val();
        var visual = $("[name='visual']").val();
        var data = {
            bundle_num: bundle_num,
            coil_num: coil_num,
            workorder_id: workorder_id,
            dies_num: dies_number,
            diameter_ujung: diameter_ujung,
            diameter_tengah: diameter_tengah,
            diameter_ekor: diameter_ekor,
            kelurusan_aktual: kelurusan_aktual,
            panjang_aktual: panjang_aktual,
            berat_fg: berat_fg,
            pcs_per_bundle: pcs_per_bundle,
            bundle_judgement: bundle_judgement,
            visual: visual
        };
        storeData(data);
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
                        '<div class="col-sm-7">' +
                        '</div>' +
                        '<div class="col-sm-1">' + 
                            '<a href="'+ window.location.origin + '/operator/production/' + response['id'] + '/edit" class="btn btn-primary">Edit</a>' + 
                        '</div>' + 
                        '<div class="col-sm-1">' + 
                            '<form action="'+window.location.origin+'/operator/production/' + response['id'] + '/delete"  method="POST"> @csrf @method("DELETE") <input type="submit" class="btn btn-danger" value="Delete"></form>' + 
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
            }
        });
    });

    $('#judgement-select').on('change',function(event)
    {
        if ($('#judgement-select').val() == '0') {
            // console.log('bad selected');
            $('#visual-options').html(
                '<option disabled selected value="">-- Select Judgement --</option>'+
                '<option value="PO" @if (old('visual') == 'PO')'+
                    'selected'+
                '@endif>PO</option>'+
                '<option value="OT" @if (old('visual') == 'OT')'+
                    'selected'+
                '@endif>OT</option>'+
                '<option value="IL" @if (old('visual') == 'IL')'+
                    'selected'+
                '@endif>IL</option>'+
                '<option value="OS" @if (old('visual') == 'OS')'+
                    'selected'+
                '@endif>OS</option>'+
                '<option value="LS" @if (old('visual') == 'LS')'+
                    'selected'+
                '@endif>LS</option>'+
                '<option value="OVAL" @if (old('visual') == 'OVAL')'+
                    'selected'+
                '@endif>OVAL</option>'+
                '<option value="TS" @if (old('visual') == 'TS')'+
                    'selected'+
                '@endif>TS</option>'+
                '<option value="BM" @if (old('visual') == 'BM')'+
                    'selected'+
                '@endif>BM</option>'+
                '<option value="CM" @if (old('visual') == 'CM')'+
                    'selected'+
                '@endif>CM</option>'+
                '<option value="SP" @if (old('visual') == 'SP')'+
                    'selected'+
                '@endif>SP</option>'+
                '<option value="MH" @if (old('visual') == 'MH')'+
                    'selected'+
                '@endif>MH</option>'+
                '<option value="RUSTY" @if (old('visual') == 'RUSTY')'+
                    'selected'+
                '@endif>RUSTY</option>'
            );
        }

        if ($('#judgement-select').val() == '1') {
            // console.log('Good selected');
            $('#visual-options').html(
                '<option disabled selected value="">-- Select Judgement --</option>'+
                '<option value="OK" @if (old('visual') == 'OK')'+
                    'selected'+
                '@endif>OK</option>'+
                '<option value="SP/OK" @if (old('visual') == 'SP/OK')'+
                    'selected'+
                '@endif>SP/OK</option>'+
                '<option value="BM/OK" @if (old('visual') == 'BM/OK')'+
                    'selected'+
                '@endif>BM/OK</option>'+
                '<option value="TS/OK" @if (old('visual') == 'TS/OK')'+
                    'selected'+
                '@endif>NG/OK</option>'+
                '<option value="OT (Besar)/OK" @if (old('visual') == 'OT (Besar)/OK')'+
                    'selected'+
                '@endif>OT (Besar)/OK</option>'
            );   
        }
    })
</script>
@endpush
