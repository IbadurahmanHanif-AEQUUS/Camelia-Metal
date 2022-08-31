@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    Workorder Data
                                </div>
                                <div class="card-body">
                                    <button class="btn btn-primary form-control">Workorder Data</button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
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
                                    <p href="" class="text-secondary"> Supplier: {{ $workorder->bb_supplier }}
                                    </p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Grade: {{ $workorder->bb_grade }}</p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Diameter: {{ $workorder->bb_diameter }}
                                        mm
                                    </p>
                                </li>
                                <li>
                                    <p href="" class="text-secondary"> Qty/Coil: {{ $workorder->bb_qty_pcs }}
                                        Pcs
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
                                    <p href="" class="text-secondary"> Machine:
                                        {{ $workorder->machine->name }}
                                    </p>
                                </li>
        
                            </ul>
                            <div class="mt-5 mb-3">
                                <button id="print-label" class="btn btn-sm btn-primary"
                                    @if ($workorder->status_wo == 'draft') disabled @endif>Print Label</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Monthly Recap Report</h5>
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
                                                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                            </p>
                                            <div class="chart">

                                                <canvas id="salesChart" height="180"
                                                    style="height: 180px;"></canvas>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Goal Completion</strong>
                                            </p>
                                            <div class="progress-group">
                                                Add Products to Cart
                                                <span class="float-right"><b>160</b>/200</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Complete Purchase
                                                <span class="float-right"><b>310</b>/400</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                <span class="progress-text">Visit Premium Page</span>
                                                <span class="float-right"><b>480</b>/800</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Send Inquiries
                                                <span class="float-right"><b>250</b>/500</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-text">Workorder: {{$workorder->wo_number}}</span>
                                                <br>
                                                <span class="description-text">Machine: {{$workorder->machine->name}}</span>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="descriprion-text">See More</a>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-warning"><i
                                                        class="fas fa-caret-left"></i> 0%</span>
                                                <h5 class="description-header">$10,390.90</h5>
                                                <span class="description-text">TOTAL COST</span>
                                            </div>

                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-success"><i
                                                        class="fas fa-caret-up"></i> 20%</span>
                                                <h5 class="description-header">$24,813.53</h5>
                                                <span class="description-text">TOTAL PROFIT</span>
                                            </div>

                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="description-block">
                                                <span class="description-percentage text-danger"><i
                                                        class="fas fa-caret-down"></i> 18%</span>
                                                <h5 class="description-header">1200</h5>
                                                <span class="description-text">GOAL COMPLETIONS</span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Total Runtime</span>
                                    {{-- @if (!$oee)
                                        <span class="info-box-number text-center text-muted mb-0">0</span>
                                    @else
                                        <span class="info-box-number text-center text-muted mb-0"></span>
                                    @endif
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
                                    @endif
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
                    </div> --}}
                        
                    {{-- Production Report Column --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline collapsed-card">
                                <div class="card-header">
                                    <h5 class="card-title">Production Report</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body box-profile">
                                    <label for="">Report per Bundle</label>
                                    <ul class="nav nav-pills">
                                        @foreach ($smeltings as $smelt)
                                            <li class="nav-item">
                                                <a class="nav-link smelting-number"
                                                    href="#"
                                                    id="{{ $smelt->bundle_num }}"
                                                    data-toggle="tab">{{ $smelt->bundle_num }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    @if (count($smeltingInputList) == 0)
                                        <div class="alert alert-success text-center" role="alert">
                                            All Data Already Input
                                        </div>
                                    @else
                                        <form id="production-report" action="" method="post">
                                            @csrf
                                            <label id="smelting-num">
                                                No. Leburan:
                                            </label>
                                            <div class="dropdown-divider"></div>
                                            <div class="row">
                                                <input hidden name="workorder_id" type="text"
                                                class="form-control @error('workorder_id') is-invalid @enderror"
                                                placeholder="No. Leburan"
                                                value="{{ $workorder->id ?? old('workorder_id') }}">
                                                <div class="col-6">
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
                                                </div>
                                                <div class="col-6">
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
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <button class="form-control btn btn-primary"
                                                                    style="margin-left:200px;">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Downtime Report --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card direct-chat card-primary card-outline direct-chat-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Downtime Report</h3>
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
                                <div class="card-footer"></div>
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

        $('a.smelting-number').on('click',function(event){
            Swal.fire({
                title: '<strong>HTML <u>example</u></strong>',
                html:
                '<div class="row">' +
                    '<div class="col-6">' +
                        '<div class="form-group">' +
                            '<label class="float-left">Dies Number</label>' +
                            '<p>12345678</p>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label class="float-left">Diameter Ujung</label>' +
                            '<p>10 mm</p>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label class="float-left">Diameter Tengah</label>' +
                            '<p>12 mm</p>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label class="float-left">Diameter Ekor</label>' +
                            '<p>12 mm</p>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<label class="float-left">Kelurusan Aktual</label>' +
                            '<p>12 mm</p>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-6">' +
                        '<li class="list-group-item">' +
                            '<b>Berat FG</b>' +
                            '<p class="float-right"></p>' + 
                        '</li>' +
                        '<li class="list-group-item">' +
                            '<b>Pcs Per Bundle</b>' +
                            '<p class="float-right"></p>' +
                        '</li>' +
                        '<li class="list-group-item">' +
                            '<b>Bundle Judgement</b>' +
                            '<p class="float-right"></p>' +
                        '</li>' +
                        '<li class="list-group-item">' +
                            '<b>Visual</b>' +
                            '<p class="float-right"></p>' +
                        '</li>' +
                    '</div>' +
                '</div>',
                width: '1000px',
                showCloseButton: false,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText:'OK',
                confirmButtonAriaLabel: 'Thumbs up, great!',
            });
            console.log(event.currentTarget.id);
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
    })
</script>
<script>
    $(document).ready(function(){
        updateDowntimeList();
    });

    let aChannel = Echo.channel('channel-downtime');
    aChannel.listen('DowntimeCaptured', function(data) {
        if (data.downtime.status == 'run') {
            Swal.fire({
                icon: 'info',
                title: 'Downtime Captured',
                showConfirmButton: false,
                timer: 3000
            });
        }
        updateDowntimeList();
    });

    function updateDowntimeList(){
      $.ajax({
          url:'{{route('downtime.updateDowntime')}}',
          type:'POST',
          dataType: 'json',
          data:{
            _token: '{{csrf_token()}}',
          },
          success:function(response){
            $('#downtime-list-count').html(response.data.length);
            var data = response.data;
            var downtimeList = '';
            for (let index = 0; index < data.length; index++) {
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
                                                '<select onchange="updateReason('+downtimeNumber+')" name="dt-category-' + downtimeNumber + '" class="form-control">' +
                                                    '<option value="" disabled selected>-- Select Downtime Category --</option>' +
                                                    '<option value="management">Management Downtime</option>' +
                                                    '<option value="waste">Waste Downtime</option>' +
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
                downtimeList += cardOpeningDiv +
                                '<div class="card-header">'+
                                    dtTime +
                                    downtimeListBody +
                                '</div>' +
                            '</div>';
            }
            $('#downtime-list').html(downtimeList);
          }
        });
    };

    function storeDowntimeReason(downtime_number)
    {
        var downtimeCategory = $('select[name="dt-category-'+downtime_number+'"]').val();
        var downtimeReason = $('select[name="dt-reason-'+downtime_number+'"]').val();
        var downtimeRemarks = $('select[name="dt-remarks-'+downtime_number+'"]').val();
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
    };

    function updateReason(downtime_number)
    {
        var downtimeCategory = $('[name="dt-category-'+downtime_number+'"]').val();
            if (downtimeCategory == 'management') {
                $("[name='dt-reason-"+downtime_number+"']").html(
                    '<option value="" disabled selected>-- Select Reason --</option>' +
                    '<option value="briefing">Briefing</option>' +
                    '<option value="check Shot Blast">Cek Shot Blast</option>' +
                    '<option value="Cek Mesin">Cek Mesin</option>' +
                    '<option value="Pointing / Roll / Bubble">Pointing / Roll / Bubble</option>' +
                    '<option value="Setting Awal">Setting Awal</option>' +
                    '<option value="Selesai Satu">Selesai Satu</option>' +
                    '<option value="Bersih-bersih Area">Bersih-bersih Area</option>' +
                    '<option value="Preventive Maintenance">Preventive Maintenance</option>'
                )
            }
            if (downtimeCategory == 'waste') {
                $("[name='dt-reason-"+downtime_number+"']").html(
                    '<option value="" disabled selected>-- Select Reason --</option>' +
                    '<option value="Bongkar Pasang">Bongkar Pasang</option>' +
                    '<option value="Tunggu Bahan">Tunggu Bahan</option>' +
                    '<option value="Ganti Bahan">Ganti Bahan</option>' +
                    '<option value="Tunggu Dies">Tunggu Dies</option>' +
                    '<option value="Gosok Dies">Gosok Dies</option>' +
                    '<option value="Ganti Part Shot Blast">Ganti Part Shot Blast</option>' +
                    '<option value="Putus Dies">Putus Dies</option>' +
                    '<option value="Setting Ulang">Setting Ulang</option>' +
                    '<option value="Ganti Polishing">Ganti Polishing</option>' +
                    '<option value="Ganti Nozzle">Ganti Nozzle</option>' +
                    '<option value="Ganti Roller">Ganti Roller</option>' +
                    '<option value="Dies Rusak">Dies Rusak</option>' +
                    '<option value="Trouble Mesin">Trouble Mesin</option>' +
                    '<option value="Validasi QC">Validasi QC</option>' +
                    '<option value="Mesin Trouble">Mesin Trouble</option>' +
                    '<option value="Tambahan Waktu Setting">Tambahan Waktu Setting</option>'
                )
            }
    }
</script>
@endpush
