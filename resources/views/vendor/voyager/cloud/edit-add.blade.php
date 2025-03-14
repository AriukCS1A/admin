@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ route('voyager.cloud.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="panel">
                    <div class="panel-body">
                        {{-- Cloudinary Upload --}}
                        <div class="form-group">
                            <label for="cloudinary-upload">Upload Image to Cloudinary</label>
                            <input type="file" id="cloudinary-upload" class="form-control" accept="image/*">

                            <input type="hidden" name="pic" id="cloudinary-url" value="{{ $dataTypeContent->pic ?? '' }}">

                            @if (!empty($dataTypeContent->pic))
                                <img src="{{ $dataTypeContent->pic }}" style="max-width:200px; margin-top:10px;">
                            @endif
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

<script>
    document.getElementById('cloudinary-upload').addEventListener('change', async function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', 'voyager');
        formData.append('folder', 'voyager_uploads');

        const res = await fetch('https://api.cloudinary.com/v1_1/dzwchq5e5/image/upload', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.secure_url) {
            document.getElementById('cloudinary-url').value = data.secure_url;
            alert('✅ Зураг амжилттай Cloudinary-д хадгалагдлаа!');
        } else {
            alert('❌ Upload амжилтгүй боллоо!');
            console.log(data);
        }
    });
</script>
@endsection
