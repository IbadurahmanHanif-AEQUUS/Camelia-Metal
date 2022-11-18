@extends('templates.default')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Bundle Data</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('spvproduction.update',$production)}}" method="POST">
                                @csrf
                                @method("PUT")
                                @if($errors->any())
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                @endif
                                <input hidden name="workorder_id" type="text" class="form-control" placeholder="Workorder Id" value="{{old('workorder_id') ?? $production->workorder_id}}">
                                <div class="form-group">
                                    <label for="">Bundle Number</label>
                                    <select name="bundle_num" class="form-control @error('bundle_num') is-invalid @enderror">
                                        <option value="{{ $production->bundle_num }}" selected >{{$production->bundle_num}}</option>
                                    </select>
                                    @error('bundle_num')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Coil Number</label>
                                    <select name="coil_num"
                                        class="form-control @error('coil_num') is-invalid @enderror">
                                        <option value="">-- Select Coil Number --</option>
                                        @foreach ($smeltings as $smelt)
                                            <option value="{{ $smelt->id }}"
                                                @if ($smelt->id == $production->coil_num || old('coil_num') == $smelt->id)
                                                    selected
                                                @endif>Coil Num : {{ $smelt->coil_num }} - No. Leburan : {{($smelt->smelting_num)}} - Berat : {{$smelt->weight}} Kg</option>
                                        @endforeach
                                    </select>
                                    @error('coil_num')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Dies Number</label>
                                    <input name="dies_num" type="text" class="form-control @error('dies_num') is-invalid @enderror" placeholder="Dies Number" value="{{old('dies_num') ?? $production->dies_num}}">
                                    @error('dies_num')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Diameter Ujung</label>
                                    <input name="diameter_ujung" type="text" class="form-control @error('diameter_ujung') is-invalid @enderror" placeholder="Diameter Ujung" value="{{old('diameter_ujung') ?? $production->diameter_ujung}}">
                                    @error('diameter_ujung')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Diameter Tengah</label>
                                    <input name="diameter_tengah" type="text" class="form-control @error('diameter_tengah') is-invalid @enderror" placeholder="Diameter Tengah" value="{{old('diameter_tengah') ?? $production->diameter_tengah}}">
                                    @error('diameter_tengah')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Diameter Ekor</label>
                                    <input name="diameter_ekor" type="text" class="form-control @error('diameter_ekor') is-invalid @enderror" placeholder="Diameter Ekor" value="{{old('diameter_ekor') ?? $production->diameter_ekor}}">
                                    @error('diameter_ekor')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Kelurusan Aktual</label>
                                    <input name="kelurusan_aktual" type="text" class="form-control @error('kelurusan_aktual') is-invalid @enderror" placeholder="Kelurusan Aktual" value="{{old('kelurusan_aktual') ?? $production->kelurusan_aktual}}">
                                    @error('kelurusan_aktual')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Panjang Aktual</label>
                                    <input name="panjang_aktual" type="text" class="form-control @error('panjang_aktual') is-invalid @enderror" placeholder="Panjang Aktual" value="{{old('panjang_aktual') ?? $production->panjang_aktual}}">
                                    @error('panjang_aktual')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Finish Good</label>
                                    <input name="berat_fg" type="text" class="form-control @error('berat_fg') is-invalid @enderror" placeholder="Berat Finish Good" value="{{old('berat_fg') ?? $production->berat_fg}}">
                                    @error('berat_fg')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Qty per bundle (Pcs)</label>
                                    <input name="pcs_per_bundle" type="text" class="form-control @error('pcs_per_bundle') is-invalid @enderror" placeholder="Qty per bundle (Pcs)" value="{{old('pcs_per_bundle') ?? $production->pcs_per_bundle}}">
                                    @error('pcs_per_bundle')
                                        <span class="text-danger help-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Bundle Judgement</label>
                                    <select name="bundle_judgement" id="judgement-select"
                                        class="form-control @error('bundle_judgement') is-invalid @enderror">
                                        <option value="">-- Select Judgement --</option>
                                        <option value="1" @if ($production->bundle_judgement == '1')
                                            selected
                                        @endif>Good</option>
                                        <option value="0" @if ($production->bundle_judgement == '0')
                                            selected
                                        @endif>Not Good</option>
                                    </select>
                                    @error('bundle_judgement')
                                        <span class="text-danger help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Visual</label>
                                    <select name="visual" id="visual-options" class="form-control @error('visual') is-invalid @enderror">
                                    </select>
                                    @error('visual')
                                        <span class="text-danger help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input value="Apply" type="submit" class="btn btn-primary">
                                </div>
                            </form>
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
        $(document).ready(function(){
            if ($('#judgement-select').val() == '0') {
                // console.log('bad selected');
                $('#visual-options').html(
                    '<option disabled selected value="">-- Select Judgement --</option>'+
                    '<option value="PO" @if (old('visual') == 'PO' || $production->visual == 'PO')'+
                        'selected'+
                    '@endif>PO</option>'+
                    '<option value="OT" @if (old('visual') == 'OT' || $production->visual == 'OT')'+
                        'selected'+
                    '@endif>OT</option>'+
                    '<option value="IL" @if (old('visual') == 'IL' || $production->visual == 'IL')'+
                        'selected'+
                    '@endif>IL</option>'+
                    '<option value="OS" @if (old('visual') == 'OS' || $production->visual == 'OS')'+
                        'selected'+
                    '@endif>OS</option>'+
                    '<option value="LS" @if (old('visual') == 'LS' || $production->visual == 'LS')'+
                        'selected'+
                    '@endif>LS</option>'+
                    '<option value="OVAL" @if (old('visual') == 'OVAL' || $production->visual == 'OVAL')'+
                        'selected'+
                    '@endif>OVAL</option>'+
                    '<option value="TS" @if (old('visual') == 'TS' || $production->visual == 'TS')'+
                        'selected'+
                    '@endif>TS</option>'+
                    '<option value="BM" @if (old('visual') == 'BM' || $production->visual == 'BM')'+
                        'selected'+
                    '@endif>BM</option>'+
                    '<option value="CM" @if (old('visual') == 'CM' || $production->visual == 'CM')'+
                        'selected'+
                    '@endif>CM</option>'+
                    '<option value="SP" @if (old('visual') == 'SP' || $production->visual == 'SP')'+
                        'selected'+
                    '@endif>SP</option>'+
                    '<option value="MH" @if (old('visual') == 'MH' || $production->visual == 'MH')'+
                        'selected'+
                    '@endif>MH</option>'+
                    '<option value="RUSTY" @if (old('visual') == 'RUSTY' || $production->visual == 'RUSTY')'+
                        'selected'+
                    '@endif>RUSTY</option>'
                );
            }

            if ($('#judgement-select').val() == '1') {
                // console.log('Good selected');
                $('#visual-options').html(
                    '<option disabled selected value="">-- Select Judgement --</option>'+
                    '<option value="OK" @if (old('visual') == 'OK' || $production->visual == 'OK')'+
                        'selected'+
                    '@endif>OK</option>'+
                    '<option value="SP/OK" @if (old('visual') == 'SP/OK' || $production->visual == 'SP/OK')'+
                        'selected'+
                    '@endif>SP/OK</option>'+
                    '<option value="BM/OK" @if (old('visual') == 'BM/OK' || $production->visual == 'BM/OK')'+
                        'selected'+
                    '@endif>BM/OK</option>'+
                    '<option value="TS/OK" @if (old('visual') == 'TS/OK' || $production->visual == 'TS/OK')'+
                        'selected'+
                    '@endif>NG/OK</option>'+
                    '<option value="OT (Besar)/OK" @if (old('visual') == 'OT (Besar)/OK' || $production->visual == 'OT (Besar)/OK')'+
                        'selected'+
                    '@endif>OT (Besar)/OK</option>'
                );   
            }
        })
            
        
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