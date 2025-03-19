@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.sale.update', $dataTypeContent->id) }}@else{{ route('voyager.sale.store') }}@endif" method="POST">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- 🎯 Image selection by product name --}}
                        <div class="form-group">
                            <label for="product_id">🖼 Зураг сонгох</label>
                            <select name="product_id" class="form-control">
                                <option value="">-- Сонгоно уу --</option>
                                @foreach(App\Models\Products::all() as $pic)
                                    <option value="{{ $pic->id }}"
                                        {{ (isset($dataTypeContent->product_id) && $dataTypeContent->product_id == $pic->id) ? 'selected' : '' }}>
                                        {{ $pic->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div style="margin-top: 10px;">
                                @php
                                    $selectedImage = App\Models\Products::find($dataTypeContent->product_id ?? null);
                                @endphp
                                @if ($selectedImage)
                                    @php $ext = pathinfo($selectedImage->pic, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $selectedImage->pic }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $selectedImage->pic }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="percent">🔗 Percent</label>
                            <input type="text" name="percent" class="form-control" value="{{ $dataTypeContent->percent ?? '' }}">
                        </div>
                       

                        {{-- Start Date --}}
                        <div class="form-group">
                            <label for="startDate">🕒 Start Date</label>
                            <input type="date" name="startDate" class="form-control" value="{{ isset($dataTypeContent->startDate) ? \Carbon\Carbon::parse($dataTypeContent->startDate)->format('Y-m-d') : '' }}">
                        </div>

                        {{-- End Date --}}
                        <div class="form-group">
                            <label for="endDate">🕒 End Date</label>
                            <input type="date" name="endDate" class="form-control" value="{{ isset($dataTypeContent->endDate) ? \Carbon\Carbon::parse($dataTypeContent->endDate)->format('Y-m-d') : '' }}">
                        </div>


                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">💾 Хадгалах</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
