@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->rewardId)){{ route('voyager.reward.update', $dataTypeContent->rewardId) }}@else{{ route('voyager.reward.store') }}@endif" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($dataTypeContent->rewardId))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- Cloudinary Upload --}}
                        <div class="form-group">
                            <label for="cloudinary-upload">📷 Upload Image or Video</label>
                            <input type="file" id="cloudinary-upload" class="form-control" accept="image/*,video/*">
                            <input type="hidden" name="productPhoto" id="cloudinary-url" value="{{ $dataTypeContent->productPhoto ?? '' }}">

                            <div id="cloud-preview" style="margin-top: 10px;">
                                @if (!empty($dataTypeContent->productPhoto))
                                    @php $ext = pathinfo($dataTypeContent->productPhoto, PATHINFO_EXTENSION); @endphp
                                    @if(in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $dataTypeContent->productPhoto }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $dataTypeContent->productPhoto }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">🔗 Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $dataTypeContent->name ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="info">📄 Info</label>
                            <textarea name="info" class="form-control">{{ $dataTypeContent->info ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="requiredMonth">📅 Required Month</label>
                            <input type="number" name="requiredMonth" class="form-control" value="{{ $dataTypeContent->requiredMonth ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="requiredAge">📅 Required Age</label>
                            <input type="number" name="requiredAge" class="form-control" value="{{ $dataTypeContent->requiredAge ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="validFrom">🕒 Valid From</label>
                            <input type="date" name="validFrom" class="form-control" value="{{ isset($dataTypeContent->validFrom) ? \Carbon\Carbon::parse($dataTypeContent->validFrom)->format('Y-m-d') : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="validTo">🕒 Valid To</label>
                            <input type="date" name="validTo" class="form-control" value="{{ isset($dataTypeContent->validTo) ? \Carbon\Carbon::parse($dataTypeContent->validTo)->format('Y-m-d') : '' }}">
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">💾 Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Cloudinary Upload --}}
<script>
    document.getElementById('cloudinary-upload').addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', 'voyager');
        formData.append('folder', 'voyager_uploads');

        const isVideo = file.type.startsWith('video/');
        const resourceType = isVideo ? 'video' : 'image';

        try {
            const res = await fetch(`https://api.cloudinary.com/v1_1/dzwchq5e5/${resourceType}/upload`, {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (data.secure_url) {
                document.getElementById('cloudinary-url').value = data.secure_url;
                const preview = document.getElementById('cloud-preview');
                preview.innerHTML = isVideo
                    ? `<video src="${data.secure_url}" controls style="max-width: 300px;"></video>`
                    : `<img src="${data.secure_url}" style="max-width: 200px;">`;

                alert('✅ Upload success!');
            } else {
                alert('❌ Upload failed!');
                console.log(data);
            }
        } catch (err) {
            alert('⚠️ Cloudinary upload error');
            console.error(err);
        }
    });
</script>
@endsection
