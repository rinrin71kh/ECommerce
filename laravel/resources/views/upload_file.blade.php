<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>

    <h2>Upload Image</h2>

    @if(session('original_url'))
        <p><strong>Original:</strong> <a href="{{ session('original_url') }}" target="_blank">View</a></p>
        <p><strong>Thumbnail:</strong> <a href="{{ session('thumbnail_url') }}" target="_blank">View</a></p>
        <img src="{{ session('thumbnail_url') }}" alt="Thumbnail" style="width:200px;height:200px;">
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required />
        <button type="submit">Upload</button>
    </form>

</body>
</html>
