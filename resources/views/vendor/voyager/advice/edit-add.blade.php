@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.advice.update', $dataTypeContent->id) }}@else{{ route('voyager.banner.store') }}@endif" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- Cloudinary Upload --}}
                        <div class="form-group">
                            <label for="cloudinary-upload">📷 Upload Advice Image</label>
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

                        <div class="form-group">
                            <label for="name">📄 name</label>
                            <input type="text" name="name" class="form-control" value="{{ $dataTypeContent->name ?? '' }}">
                        </div>

                        <div class="form-group">
    <label for="momchange_id">Momchange</label>
    <select name="momchange_id" class="form-control">
        <option value="">-- None --</option>
        @foreach(App\Models\Momchange::all() as $momchange)
            <option value="{{ $momchange->id }}"
                {{ (isset($dataTypeContent->momchange_id) && $dataTypeContent->momchange_id == $momchange->id) ? 'selected' : '' }}>
                {{ $momchange->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="babydev_id">Babydev</label>
    <select name="babydev_id" class="form-control">
        <option value="">-- None --</option>
        @foreach(App\Models\Babydev::all() as $babydev)
            <option value="{{ $babydev->id }}"
                {{ (isset($dataTypeContent->babydev_id) && $dataTypeContent->babydev_id == $babydev->id) ? 'selected' : '' }}>
                {{ $babydev->name }}
            </option>
        @endforeach
    </select>
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
