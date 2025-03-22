@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.memory_game_rewards.update', $dataTypeContent->id) }}@else{{ route('voyager.memory_game_rewards.store') }}@endif" method="POST">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- 🎯 Image selection by product name --}}
                        <div class="form-group">
                            <label for="reward_product_id">🖼 Зураг сонгох</label>
                            <select name="reward_product_id" class="form-control">
                                <option value="">-- Сонгоно уу --</option>
                                @foreach(App\Models\Products::all() as $photo)
                                    <option value="{{ $photo->id }}"
                                        {{ (isset($dataTypeContent->reward_product_id) && $dataTypeContent->reward_product_id == $photo->id) ? 'selected' : '' }}>
                                        {{ $photo->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div style="margin-top: 10px;">
                                @php
                                    $selectedImage = App\Models\Products::find($dataTypeContent->reward_product_id ?? null);
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

                        <div class="form-group">
                            <label for="reward_type">🔗 Reward type</label>
                            <input type="text" name="reward_type" class="form-control" value="{{ $dataTypeContent->reward_type ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="reward_points">🔗 Reward Points</label>
                            <input type="text" name="reward_points" class="form-control" value="{{ $dataTypeContent->reward_points ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="max_winners_per_month">🔗 Max Winners</label>
                            <input type="text" name="max_winners_per_month" class="form-control" value="{{ $dataTypeContent->max_winners_per_month ?? '' }}">
                        </div>

                        <div class="form-group">
    <label>🕒 Created at</label>
    <input type="text" class="form-control" value="{{ $dataTypeContent->created_at ?? '' }}" readonly>
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
