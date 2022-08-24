@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Workorder</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Runtime</span>
                                            {{-- @if (!$oee)
                                                <span class="info-box-number text-center text-muted mb-0">0</span>
                                            @else
                                                <span class="info-box-number text-center text-muted mb-0"></span>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Downtime</span>
                                            {{-- @if (!$oee)
                                                <span class="info-box-number text-center text-muted mb-0">0</span>
                                            @else
                                                <span class="info-box-number text-center text-muted mb-0"></span>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total Production</span>
                                            <span class="info-box-number text-center text-muted mb-0"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Production Performance Column --}}
                                <div class="col-6">
                                    <h4>Production Result</h4>
                                    <div class="card card-primary card-outline">
                                        <div class="card-header p-2">
                                            <p>Bundle Num</p>
                                            <ul class="nav nav-pills">
                                                @foreach ($smeltings as $smelt)
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="#production{{ $smelt->bundle_num }}"
                                                            data-toggle="tab">{{ $smelt->bundle_num }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-body box-profile">
                                            @if (count($productions) == 0)
                                                <div class="alert alert-danger text-center" role="alert">
                                                    No Data
                                                </div>
                                            @else
                                                <div class="tab-content">
                                                    @foreach ($smeltings as $smelt)
                                                        <div class="tab-pane" id="production{{ $smelt->bundle_num }}">
                                                            @php
                                                                $found = 0;
                                                            @endphp
                                                            @foreach ($productions as $prod)
                                                                @if ($smelt->bundle_num == $prod->bundle_num)
                                                                    <ul class="list-group list-group-unbordered mb-3">
                                                                        @foreach ($smeltings as $smelt)
                                                                            @if ($smelt->bundle_num == $prod->bundle_num)
                                                                                <h3 class="profile-username text-center">No.
                                                                                    Leburan : {{ $smelt->smelting_num }}
                                                                                </h3>
                                                                            @endif
                                                                        @endforeach
                                                                        <li class="list-group-item">
                                                                            <b>Dies Number</b>
                                                                            <p class="float-right">{{ $prod->dies_num }}</p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Diameter Ujung</b>
                                                                            <p class="float-right">
                                                                                {{ $prod->diameter_ujung }} mm</p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Diameter Tengah</b>
                                                                            <p class="float-right">
                                                                                {{ $prod->diameter_tengah }} mm</p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Diameter Ekor</b>
                                                                            <p class="float-right">
                                                                                {{ $prod->diameter_ekor }} mm</p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Kelurusan Actual</b>
                                                                            <p class="float-right">
                                                                                {{ $prod->kelurusan_aktual }} mm</p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Berat FG</b>
                                                                            <p class="float-right">{{ $prod->berat_fg }} Kg
                                                                            </p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Pcs Per Bundle</b>
                                                                            <p class="float-right">
                                                                                {{ $prod->pcs_per_bundle }} Pcs</p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Bundle Judgement</b>
                                                                            <p class="float-right">
                                                                                @if ($prod->bundle_judgement == '1')
                                                                                    Good
                                                                                @else
                                                                                    No Good
                                                                                @endif
                                                                                {{-- {{$prod->bundle_judgement}} --}}
                                                                            </p>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <b>Visual</b>
                                                                            <p class="float-right">
                                                                                @if ($prod->visual == 1)
                                                                                    Good
                                                                                @endif

                                                                                {{-- {{$prod->visual}} --}}
                                                                            </p>
                                                                        </li>
                                                                    </ul>
                                                                    @php
                                                                        $found = 1;
                                                                    @endphp
                                                                @break
                                                            @endif
                                                        @endforeach
                                                        @if ($found == 0)
                                                            <h3 class="profile-username text-center">No. Leburan :
                                                                {{ $smelt->smelting_num }}</h3>
                                                            <div class="alert alert-danger text-center" role="alert">
                                                                No Data
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Production Report Column --}}
                            <div class="col-6">
                                <h4>Production Report</h4>
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        Production Report
                                    </div>
                                    <div class="card-body box-profile">
                                        @if (count($smeltingInputList) == 0)
                                            <div class="alert alert-success text-center" role="alert">
                                                All Data Already Input
                                            </div>
                                        @else
                                            <form id="production-report" action="" method="post">
                                                @csrf
                                                <h3 id="smelting-num" class="profile-username text-center">No. Leburan :
                                                </h3>
                                                <input hidden name="workorder_id" type="text"
                                                    class="form-control @error('workorder_id') is-invalid @enderror"
                                                    placeholder="No. Leburan"
                                                    value="{{ $workorder->id ?? old('workorder_id') }}">
                                                <div class="form-group">
                                                    <label for="">Bundle Number</label>
                                                    <select name="bundle-num"
                                                        class="form-control @error('bundle-num') is-invalid @enderror">
                                                        <option value="">-- Select Bundle Number --</option>
                                                        @foreach ($smeltingInputList as $smelt)
                                                            <option value="{{ $smelt }}">{{ $smelt }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                                    <label for="">Diameter Ujung</label>
                                                    <input type="text" name="diameter-ujung"
                                                        class="form-control @error('diameter-ujung') is-invalid @enderror"
                                                        placeholder="Diameter Ujung"
                                                        value="{{ old('diameter-ujung') }}">
                                                    @error('diameter-ujung')
                                                        <span class="text-danger help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Diameter Tengah</label>
                                                    <input type="text" name="diameter-tengah"
                                                        class="form-control @error('diameter-tengah') is-invalid @enderror"
                                                        placeholder="Diameter Tengah"
                                                        value="{{ old('diameter-tengah') }}">
                                                    @error('diameter-tengah')
                                                        <span class="text-danger help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Diameter Ekor</label>
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
                                                <div class="form-group">
                                                    <label for="">Panjang Aktual</label>
                                                    <input type="text" name="panjang-aktual"
                                                        class="form-control @error('panjang-aktual') is-invalid @enderror"
                                                        placeholder="Panjang Aktual"
                                                        value="{{ old('panjang-aktual') }}">
                                                    @error('panjang-aktual')
                                                        <span class="text-danger help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Berat Finish Good</label>
                                                    <input type="text" name="berat-fg"
                                                        class="form-control @error('berat-fg') is-invalid @enderror"
                                                        placeholder="Berat Finish Good"
                                                        value="{{ old('berat-fg') }}">
                                                    @error('berat-fg')
                                                        <span class="text-danger help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Pcs per Bundle</label>
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
                                                    <select name="bundle-judgement" id=""
                                                        class="form-control @error('bundle-judgement') is-invalid @enderror">
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
                                                    <select name="visual" id=""
                                                        class="form-control @error('visual') is-invalid @enderror">
                                                        <option value="">-- Select Judgement --</option>
                                                        <option value="1">Good</option>
                                                        <option value="0">Not Good</option>
                                                    </select>
                                                    @error('visual')
                                                        <span class="text-danger help-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-1">
                                                            <button class="btn btn-primary">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Downtime Report</h4>
                                @foreach ($downtimes as $downtime)
                                    <div class="card card-@if($downtime->is_remark_filled) danger @endif">
                                        <div class="card-header">
                                            <h3 class="card-title">Warning</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            The body of the card
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        {{-- @if ($oee_val != 0)
                                <h1 class="text-muted">OEE</h1>
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <div class="chart tab-pane active" id="oee-chart" style="position: relative; height: 300px;">
                                            <canvas id="oee-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                                {{-- <h2 class="text-primary">{{round($oee_val,2)}} %</h2>
                                <h5 class="text-muted">OTR : {{round($otr,2)}} %</h5>
                                <h5 class="text-muted">PER : {{round($per,2)}} %</h5>
                                <h5 class="text-muted">QR : {{round($qr,2)}} %</h5> --}}
                        {{-- <br>
                            @endif --}}
                        <div class="text-muted">
                            <p class="text-sm">Workorder Number
                                <b class="d-block">{{ $workorder->wo_number }}</b>
                            </p>
                            <p class="text-sm">Created By
                                <b class="d-block">{{ $createdBy->name }}</b>
                            </p>
                        </div>
                        <h5 class="mt-5 text-muted">Bahan Baku</h5>
                        <ul class="list-unstyled">
                            <li>
                                <p href="" class="text-secondary"> Supplier: {{ $workorder->bb_supplier }}</p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Grade: {{ $workorder->bb_grade }}</p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Diameter: {{ $workorder->bb_diameter }} mm
                                </p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Qty/Coil: {{ $workorder->bb_qty_pcs }} Pcs
                                    / {{ $workorder->bb_qty_coil }} Pcs</p>
                            </li>
                        </ul>
                        <h5 class="mt-5 text-muted">Finish Good</h5>
                        <ul class="list-unstyled">
                            <li>
                                <p href="" class="text-secondary"> Size: {{ $workorder->fg_size_1 }} mm X
                                    {{ $workorder->fg_size_2 }} mm</p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Tolerance:
                                    {{ $workorder->tolerance_minus }} %</p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Reduction Rate:
                                    {{ $workorder->fg_reduction_rate }} %</p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Shape: {{ $workorder->fg_shape }}</p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Qty: {{ $workorder->fg_qty }} Pcs</p>
                            </li>
                        </ul>
                        <h5 class="mt-5 text-muted">Others</h5>
                        <ul class="list-unstyled">
                            <li>
                                <p href="" class="text-secondary"> Status WO:
                                    {{ $workorder->status_wo }}
                                </p>
                            </li>
                            <li>
                                <p href="" class="text-secondary"> Machine: {{ $workorder->machine->name }}
                                </p>
                            </li>

                        </ul>

                        <div class="mt-5 mb-3">
                            <button id="print-label" class="btn btn-sm btn-primary"
                                @if ($workorder->status_wo == 'draft') disabled @endif>Print Label</button>
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
    $(function() {
        // $.ajax({
        //     type: "POST",
        //     dataType: "json", 
        //     url: "{{ route('workorder.getDowntime') }}",
        //     data: {
        //         workorder_id:'{{ $workorder->id }}}',
        //         data:'management_time',
        //         _token: '{{ csrf_token() }}'
        //     },
        //     success: function(response) {
        //         var salesChartCanvas=document.getElementById('management-chart-canvas').getContext('2d');
        //         var salesChartData= {
        //                         labels:[
        //                                     'Briefing',
        //                                     'Cek Shot Blast',
        //                                     'Cek Mesin',
        //                                     'Sambung Bahan',
        //                                     'Setting Awal',
        //                                     'Selesai Satu Bundle',
        //                                     'Cleaning Area Mesin',
        //                                     'Istirahat'
        //                                 ],
        //                         datasets:[
        //                                     {
        //                                         label:'Management Downtimes',
        //                                         backgroundColor:'rgba(60,141,188,0.9)',
        //                                         borderColor:'rgba(60,141,188,0.8)',
        //                                         pointRadius:false,
        //                                         pointColor:'#3b8bba',
        //                                         pointStrokeColor:'rgba(60,141,188,1)',
        //                                         pointHighlightFill:'#fff',
        //                                         pointHighlightStroke:'rgba(60,141,188,1)',
        //                                         data: response
        //                                     },
        //                                 ]
        //                     }
        //         var salesChartOptions=  {
        //                                     maintainAspectRatio:false,
        //                                     responsive:true,
        //                                     legend:{display:false},
        //                                     scales:{xAxes:[{gridLines:{display:false}}],
        //                                     yAxes:[{gridLines:{display:false}}]}
        //                                 }
        //         var salesChart= new Chart(salesChartCanvas,{type:'bar',data:salesChartData,options:salesChartOptions});
        //     }
        // });

        // $.ajax({
        //     type: "POST",
        //     dataType: "json", 
        //     url: "{{ route('workorder.getDowntime') }}",
        //     data: {
        //         workorder_id:'{{ $workorder->id }}}',
        //         data:'downtime',
        //         _token: '{{ csrf_token() }}'
        //     },
        //     success: function(response) {
        //         var salesChartCanvas=document.getElementById('downtime-chart-canvas').getContext('2d');
        //         var salesChartData= {
        //                         labels:[
        //                                     'Bongkar Pasang Dies',
        //                                     'Tunggu Bahan Baku',
        //                                     'Ganti Bahan Baku',
        //                                     'Tunggu Dies',
        //                                     'Gosok Dies',
        //                                     'Ganti Part Shot Blast',
        //                                     'Setting Ulang Kelurusan',
        //                                     'Ganti Polishing Dies',
        //                                     'Ganti Nozle Polishing Mesin',
        //                                     'Ganti Roller Straightener',
        //                                     'Dies Rusak',
        //                                     'Mesin Trouble Operator',
        //                                     'Validasi QC',
        //                                     'Mesin Trouble Maintenance',
        //                                 ],
        //                         datasets:[
        //                                     {
        //                                         label:'Downtimes',
        //                                         backgroundColor:'rgba(60,141,188,0.9)',
        //                                         borderColor:'rgba(60,141,188,0.8)',
        //                                         pointRadius:false,
        //                                         pointColor:'#3b8bba',
        //                                         pointStrokeColor:'rgba(60,141,188,1)',
        //                                         pointHighlightFill:'#fff',
        //                                         pointHighlightStroke:'rgba(60,141,188,1)',
        //                                         data: response
        //                                     },
        //                                 ]
        //                     }
        //         var salesChartOptions=  {
        //                                     maintainAspectRatio:false,
        //                                     responsive:true,
        //                                     legend:{display:false},
        //                                     scales:{xAxes:[{gridLines:{display:false}}],
        //                                     yAxes:[{gridLines:{display:false}}]}
        //                                 }
        //         var salesChart= new Chart(salesChartCanvas,{type:'bar',data:salesChartData,options:salesChartOptions});
        //     }
        // });

        // $.ajax({
        //     type: "POST",
        //     dataType: "json", 
        //     url: "{{ route('workorder.getOee') }}",
        //     data: {
        //         workorder_id:'{{ $workorder->id }}',
        //         _token: '{{ csrf_token() }}'
        //     },
        //     success: function(response) {
        //         var pieChartCanvas = $('#oee-chart-canvas').get(0).getContext("2d");
        //         var pieData=    {
        //                             labels:['OEE','Waste'],
        //                             datasets:[
        //                                         {
        //                                             data:[response[0],100-response[0]],
        //                                             // data:[response[0],100-response[0]],
        //                                             backgroundColor:['#00a65a','#f56954']
        //                                         }
        //                                     ]
        //                         }
        //         var pieOptions= {
        //                             legend:{display:false},
        //                             maintainAspectRatio:false,
        //                             responsive:true
        //                         }
        //         var pieChart=new Chart(pieChartCanvas,{type:'doughnut',data:pieData,options:pieOptions})
        //     }
        // });

        $('#print-label').on('click', function() {
            event.preventDefault();
            window.open("{{ url('/report/' . $workorder->id . '/printToPdf') }}");
        });

        $("[name='bundle-num']").on('change', function(event) {
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

        $('#production-report').on('submit', function(event) {
            event.preventDefault();
            var bundle_num = $("[name='bundle-num']").val();
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

        $('#oee-report').on('submit', function(event) {
            event.preventDefault();
            var workorder_id = $("[name='oee_workorder_id']").val();
            var dt_briefing = $("[name='dt-briefing']").val();
            var dt_cek_shot_blast = $("[name='dt-cek-shot-blast']").val();
            var dt_cek_mesin = $("[name='dt-cek-mesin']").val();
            var dt_sambung_bahan = $("[name='dt-sambung-bahan']").val();
            var dt_bongkar_pasang_dies = $("[name='dt-bongkar-pasang-dies']").val();
            var dt_setting_awal = $("[name='dt-setting-awal']").val();
            var dt_selesai_satu_bundle = $("[name='dt-selesai-satu-bundle']").val();
            var dt_cleaning_area_mesin = $("[name='dt-cleaning-area-mesin']").val();
            var dt_tunggu_bahan_baku = $("[name='dt-tunggu-bahan-baku']").val();
            var dt_ganti_bahan_baku = $("[name='dt-ganti-bahan-baku']").val();
            var dt_tunggu_dies = $("[name='dt-tunggu-dies']").val();
            var dt_gosok_dies = $("[name='dt-gosok-dies']").val();
            var dt_ganti_part_shot_blast = $("[name='dt-ganti-part-shot-blast']").val();
            var dt_putus_dies = $("[name='dt-putus-dies']").val();
            var dt_setting_ulang_kelurusan = $("[name='dt-setting-ulang-kelurusan']").val();
            var dt_ganti_polishing_dies = $("[name='dt-ganti-polishing-dies']").val();
            var dt_ganti_nozle_polishing_mesin = $("[name='dt-ganti-nozle-polishing-mesin']").val();
            var dt_ganti_roller_straightener = $("[name='dt-ganti-roller-straightener']").val();
            var dt_dies_rusak = $("[name='dt-dies-rusak']").val();
            var dt_mesin_trouble_operator = $("[name='dt-mesin-trouble-operator']").val();
            var dt_validasi_qc = $("[name='dt-validasi-qc']").val();
            var dt_mesin_trouble_maintenance = $("[name='dt-mesin-trouble-maintenance']").val();
            var dt_istirahat = $("[name='dt-istirahat']").val();
            var total_runtime = $("[name='total-runtime']").val();
            var total_downtime = $("[name='total-downtime']").val();

            var data = {
                workorder_id: workorder_id,
                dt_briefing: dt_briefing,
                dt_cek_shot_blast: dt_cek_shot_blast,
                dt_cek_mesin: dt_cek_mesin,
                dt_sambung_bahan: dt_sambung_bahan,
                dt_bongkar_pasang_dies: dt_bongkar_pasang_dies,
                dt_setting_awal: dt_setting_awal,
                dt_selesai_satu_bundle: dt_selesai_satu_bundle,
                dt_cleaning_area_mesin: dt_cleaning_area_mesin,
                dt_tunggu_bahan_baku: dt_tunggu_bahan_baku,
                dt_ganti_bahan_baku: dt_ganti_bahan_baku,
                dt_tunggu_dies: dt_tunggu_dies,
                dt_gosok_dies: dt_gosok_dies,
                dt_ganti_part_shot_blast: dt_ganti_part_shot_blast,
                dt_putus_dies: dt_putus_dies,
                dt_setting_ulang_kelurusan: dt_setting_ulang_kelurusan,
                dt_ganti_polishing_dies: dt_ganti_polishing_dies,
                dt_ganti_nozle_polishing_mesin: dt_ganti_nozle_polishing_mesin,
                dt_ganti_roller_straightener: dt_ganti_roller_straightener,
                dt_dies_rusak: dt_dies_rusak,
                dt_mesin_trouble_operator: dt_mesin_trouble_operator,
                dt_validasi_qc: dt_validasi_qc,
                dt_mesin_trouble_maintenance: dt_mesin_trouble_maintenance,
                dt_istirahat: dt_istirahat,
                total_runtime: total_runtime,
                total_downtime: total_downtime
            };
            storeOee(data);
        });

        function storeData(data) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ route('production.store') }}',
                data: {
                    workorder_id: data.workorder_id,
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
                    console.log(response);
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
                        position: 'top-end',
                        icon: 'error',
                        title: 'Something Went Wrong',
                        html: '<b class="text-danger">' + JSON.parse(response.responseText)
                            .message + '</b> <br><br> <B>detail</b>: ' + response
                            .responseText,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }

        function storeOee(data) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ route('production.storeOee') }}',
                data: {
                    workorder_id: data.workorder_id,
                    dt_briefing: data.dt_briefing,
                    dt_cek_shot_blast: data.dt_cek_shot_blast,
                    dt_cek_mesin: data.dt_cek_mesin,
                    dt_sambung_bahan: data.dt_sambung_bahan,
                    dt_bongkar_pasang_dies: data.dt_bongkar_pasang_dies,
                    dt_setting_awal: data.dt_setting_awal,
                    dt_selesai_satu_bundle: data.dt_selesai_satu_bundle,
                    dt_cleaning_area_mesin: data.dt_cleaning_area_mesin,
                    dt_tunggu_bahan_baku: data.dt_tunggu_bahan_baku,
                    dt_ganti_bahan_baku: data.dt_ganti_bahan_baku,
                    dt_tunggu_dies: data.dt_tunggu_dies,
                    dt_gosok_dies: data.dt_gosok_dies,
                    dt_ganti_part_shot_blast: data.dt_ganti_part_shot_blast,
                    dt_putus_dies: data.dt_putus_dies,
                    dt_setting_ulang_kelurusan: data.dt_setting_ulang_kelurusan,
                    dt_ganti_polishing_dies: data.dt_ganti_polishing_dies,
                    dt_ganti_nozle_polishing_mesin: data.dt_ganti_nozle_polishing_mesin,
                    dt_ganti_roller_straightener: data.dt_ganti_roller_straightener,
                    dt_dies_rusak: data.dt_dies_rusak,
                    dt_mesin_trouble_operator: data.dt_mesin_trouble_operator,
                    dt_validasi_qc: data.dt_validasi_qc,
                    dt_mesin_trouble_maintenance: data.dt_mesin_trouble_maintenance,
                    dt_istirahat: data.dt_istirahat,
                    total_runtime: data.total_runtime,
                    total_downtime: data.total_downtime,
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
                        position: 'top-end',
                        icon: 'error',
                        title: 'Something Went Wrong',
                        html: '<b class="text-danger">' + JSON.parse(response.responseText)
                            .message + '</b> <br><br> <B>detail</b>: ' + response
                            .responseText,
                        showConfirmButton: false,
                        // timer: 2000
                    });
                }
            });
        }
    })
</script>
@endpush
