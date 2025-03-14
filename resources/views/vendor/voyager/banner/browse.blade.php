@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Banner List</h3>
                    <div class="panel-actions">
                        <a href="{{ route('voyager.banner.create') }}" class="btn btn-success">➕ Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Media</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Branch</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>
                                    @php $ext = pathinfo($data->photo, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $data->photo }}" controls style="max-width: 100px;"></video>
                                    @elseif($data->photo)
                                        <img src="{{ $data->photo }}" style="max-width: 100px;">
                                    @else
                                        No Media
                                    @endif
                                </td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->link }}</td>
                                <td>{{ $data->startDate }}</td>
                                <td>{{ $data->endDate }}</td>
                                <td>{{ $data->branch_id }}</td>
                                <td>
                                    <a href="{{ route('voyager.banner.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.banner.destroy', $data->id) }}" method="POST" style="display:inline;">
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
        formData.append('folder', 'voyager_uploadss');

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
