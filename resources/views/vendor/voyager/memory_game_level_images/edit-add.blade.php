@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.memory_game_level_images.update', $dataTypeContent->id) }}@else{{ route('voyager.memory_game_level_images.store') }}@endif" method="POST">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- 🎯 Image selection by product name --}}
                        <div class="form-group">
                            <label for="image_id">🖼 Зураг сонгох</label>
                            <select name="image_id" class="form-control">
                                <option value="">-- Сонгоно уу --</option>
                                @foreach(App\Models\MemoryGameImages::all() as $image)
                                    <option value="{{ $image->id }}"
                                        {{ (isset($dataTypeContent->image_id) && $dataTypeContent->image_id == $image->id) ? 'selected' : '' }}>
                                        {{ $image->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div style="margin-top: 10px;">
                                @php
                                    $selectedImage = App\Models\MemoryGameImages::find($dataTypeContent->image_id ?? null);
                                @endphp
                                @if ($selectedImage)
                                    @php $ext = pathinfo($selectedImage->image_url, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $selectedImage->image_url }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $selectedImage->image_url }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- 🌱 Level selection by name --}}
                        <div class="form-group">
                            <label for="level_id">🌱 Түвшин сонгох</label>
                            <select name="level_id" class="form-control">
                                <option value="">-- Сонгоно уу --</option>
                                @foreach(App\Models\Level::all() as $level)
                                    <option value="{{ $level->id }}"
                                        {{ (isset($dataTypeContent->level_id) && $dataTypeContent->level_id == $level->id) ? 'selected' : '' }}>
                                        {{ $level->name }} ({{ $level->minPoint }} - {{ $level->maxPoint }})
                                    </option>
                                @endforeach
                            </select>
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
