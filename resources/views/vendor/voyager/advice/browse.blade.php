@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Advice List</h3>
                    <div class="panel-actions">
                        <a href="{{ route('voyager.advice.create') }}" class="btn btn-success">➕ Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Media</th>
                                <th>Name</th>
                                <th>Momchange</th>
                                <th>Babydev</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>
                                    @php $ext = pathinfo($data->pic, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $data->pic }}" controls style="max-width: 100px;"></video>
                                    @elseif($data->pic)
                                        <img src="{{ $data->pic }}" style="max-width: 100px;">
                                    @else
                                        No Media
                                    @endif
                                </td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->momchange_id }}</td>
                                <td>{{ $data->babydev_id }}</td>
                                
                                <td>
                                    <a href="{{ route('voyager.advice.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.advice.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        {{ method_exists($dataTypeContent, 'links') ? $dataTypeContent->links() : '' }}
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

            // Preview (зурган эсвэл бичлэг)
            const preview = document.getElementById('cloud-preview');
            if (isVideo) {
                preview.outerHTML = `<video src="${data.secure_url}" controls style="max-width:300px; margin-top:10px;"></video>`;
            } else {
                preview.src = data.secure_url;
                preview.style.display = 'block';
            }

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
