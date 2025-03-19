@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.bannerfilter.update', $dataTypeContent->id) }}@else{{ route('voyager.bannerfilter.store') }}@endif" method="POST">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- 🎯 Зураг сонгох --}}
                        <div class="form-group">
                            <label for="banner_id">🖼 Зураг сонгох</label>
                            <select name="banner_id" class="form-control" id="banner-select">
                                <option value="">-- Сонгоно уу --</option>
                                @foreach(App\Models\Banner::all() as $image)
                                    <option value="{{ $image->id }}"
                                        data-image="{{ $image->photo }}"
                                        {{ (isset($dataTypeContent->banner_id) && $dataTypeContent->banner_id == $image->id) ? 'selected' : '' }}>
                                        {{ $image->id }} — {{ \Illuminate\Support\Str::limit($image->description, 30) }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Preview --}}
                            <div id="preview-image" style="margin-top: 10px;">
                                @php
                                    $selectedImage = App\Models\Banner::find($dataTypeContent->banner_id ?? null);
                                @endphp
                                @if ($selectedImage)
                                    @php $ext = pathinfo($selectedImage->photo, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $selectedImage->photo }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $selectedImage->photo }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- 🌱 Түвшин сонгох --}}
                        <div class="form-group">
                            <label for="storyfilter_id">Banner эсвэл стори сонгох</label>
                            <select name="storyfilter_id" class="form-control">
                                <option value="">-- Сонгоно уу --</option>
                                @foreach(App\Models\Storyfilter::all() as $storyfilter)
                                    <option value="{{ $storyfilter->id }}"
                                        {{ (isset($dataTypeContent->storyfilter_id) && $dataTypeContent->storyfilter_id == $storyfilter->id) ? 'selected' : '' }}>
                                        {{ $storyfilter->name }}
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

@push('javascript')
<script>
    const select = document.getElementById('banner-select');
    const preview = document.getElementById('preview-image');

    function updatePreview() {
        const selectedOption = select.options[select.selectedIndex];
        const imageUrl = selectedOption.getAttribute('data-image');

        if (imageUrl) {
            const ext = imageUrl.split('.').pop().toLowerCase();
            if (['mp4', 'mov', 'webm'].includes(ext)) {
                preview.innerHTML = `<video src="${imageUrl}" controls style="max-width: 300px;"></video>`;
            } else {
                preview.innerHTML = `<img src="${imageUrl}" style="max-width: 200px;">`;
            }
        } else {
            preview.innerHTML = '';
        }
    }

    select.addEventListener('change', updatePreview);
    window.addEventListener('DOMContentLoaded', updatePreview);
</script>
@endpush
