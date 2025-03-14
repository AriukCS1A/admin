@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">

                {{-- Panel Header --}}
                <div class="panel-heading">
                    <h3 class="panel-title">Cloud Images</h3>
                </div>

                {{-- Add New Image --}}
                <div class="panel-body">
                    <form method="POST" action="{{ route('voyager.cloud.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="cloudinary-upload">📷 Upload Image to Cloudinary</label>
                            <input type="file" id="cloudinary-upload" class="form-control" accept="image/*">

                            {{-- Cloudinary линкийг хадгалах input --}}
                            <input type="hidden" name="pic" id="cloudinary-url">

                            {{-- Preview --}}
                            <img id="cloud-preview" src="#" style="max-width: 200px; margin-top: 10px; display: none;">
                        </div>

                        <button type="submit" class="btn btn-success">💾 Save</button>
                    </form>
                </div>

                {{-- Table of existing images --}}
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>

                                    <td>
                                        @if ($data->pic)
                                            <img src="{{ $data->pic }}" style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('voyager.cloud.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️ Edit</a>
                                        <form action="{{ route('voyager.cloud.destroy', $data->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Устгах уу?')">🗑 Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="text-center">
                        {{ $dataTypeContent->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- Cloudinary Upload Script --}}
<script>
    const UPLOAD_PRESET = "{{ env('CLOUDINARY_UPLOAD_PRESET', 'voyager') }}";
    document.getElementById('cloudinary-upload').addEventListener('change', async function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', UPLOAD_PRESET); // Cloudinary upload preset
        formData.append('folder', 'voyager_uploads');

        try {
            const res = await fetch('https://api.cloudinary.com/v1_1/dzwchq5e5/image/upload', {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (data.secure_url) {
                document.getElementById('cloudinary-url').value = data.secure_url;
                const preview = document.getElementById('cloud-preview');
                preview.src = data.secure_url;
                preview.style.display = 'block';
                alert('✅ Зураг амжилттай Cloudinary-д хадгалагдлаа!');
            } else {
                alert('❌ Upload амжилтгүй боллоо!');
                console.log(data);
            }
        } catch (error) {
            alert('⚠️ Cloudinary upload алдаа гарлаа');
            console.error(error);
        }
    });
</script>
@endsection
