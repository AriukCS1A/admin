@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.branches.update', $dataTypeContent->id) }}@else{{ route('voyager.branches.store') }}@endif" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- Cloudinary Upload --}}
                        <div class="form-group">
                            <label for="cloudinary-upload">📷 Upload Branches Image </label>
                            <input type="file" id="cloudinary-upload" class="form-control" accept="image/*,video/*">
                            <input type="hidden" name="pic" id="cloudinary-url" value="{{ $dataTypeContent->pic ?? '' }}">

                            <div id="cloud-preview" style="margin-top: 10px;">
                                @if (!empty($dataTypeContent->pic))
                                    @php $ext = pathinfo($dataTypeContent->pic, PATHINFO_EXTENSION); @endphp
                                    @if(in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $dataTypeContent->pic }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $dataTypeContent->pic }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label for="name">📄 Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $dataTypeContent->name ?? '' }}">
                        </div>

                        {{-- Link --}}
                        <div class="form-group">
                            <label for="Latitude">🔗 Latitude</label>
                            <input type="text" name="latitude" class="form-control" value="{{ $dataTypeContent->latitude ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="longtitude">🔗 Longtitude</label>
                            <input type="text" name="longitude" class="form-control" value="{{ $dataTypeContent->longitude ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="address">🔗 Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $dataTypeContent->address ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">🔗Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $dataTypeContent->phone ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="hour">🔗 Hour</label>
                            <input type="text" name="hour" class="form-control" value="{{ $dataTypeContent->hour ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label>📅 Created at</label>
                            <input type="text" class="form-control" value="{{ $dataTypeContent->created_at ?? '' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>🕒 Updated at</label>
                            <input type="text" class="form-control" value="{{ $dataTypeContent->updated_at ?? '' }}" readonly>
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

                alert('✅ Файл амжилттай Cloudinary-д хадгалагдлаа!');
            } else {
                alert('❌ Upload амжилтгүй боллоо!');
                console.log(data);
            }
        } catch (err) {
            alert('⚠️ Cloudinary upload алдаа гарлаа');
            console.error(err);
        }
    });
</script>
@endsection
