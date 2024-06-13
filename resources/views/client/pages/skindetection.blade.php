@extends('admin.dashboard')

@section('content')
    <div class="camera-container">
        <video id="camera" autoplay playsinline></video>
        <button
            class="px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            id="capture">Capture</button>
        <div class="image-container">
            <img id="captured-image" src="" alt="Captured Image">
        </div>
        <button
            class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-white-600 text-black hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            type="submit">Upload</button>
    </div>

    <style>
        .camera-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #999;
            /* Frame untuk container */
            padding: 10px;
            margin: 20px;
        }

        video {
            width: 100%;
            max-width: 600px;
            height: auto;
        }

        .image-container {
            margin-top: 20px;
            border: 2px solid #999;
            /* Frame untuk gambar */
            padding: 10px;
        }

        img {
            width: 100%;
            max-width: 600px;
            height: auto;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('camera');
            const captureButton = document.getElementById('capture');
            const capturedImage = document.getElementById('captured-image');

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: true
                    })
                    .then(function(stream) {
                        video.srcObject = stream;
                        video.play();
                    })
                    .catch(function(error) {
                        console.error('Error accessing the camera', error);
                    });
            } else {
                console.error('getUserMedia not supported on your browser!');
            }

            captureButton.addEventListener('click', function() {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const dataUrl = canvas.toDataURL('image/png');
                capturedImage.src = dataUrl;

                // Encode the image data to a blob
                fetch(dataUrl)
                    .then(res => res.blob())
                    .then(blob => {
                        const formData = new FormData();
                        formData.append('file', blob);

                        // Send POST request to uploadgambar endpoint
                        fetch('/uploadgambar/', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                alert(`Response from server: ${JSON.stringify(data)}`);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Failed to upload image.');
                            });
                    });
            });

        });
    </script>


    <title>Upload File</title>

    <h1>Upload File</h1>
    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 300px;">
        <button
            class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-white-600 text-black hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            type="submit">Upload</button>
    </form>

    <style>
        .foundation-images img {
            width: 100px;
            height: 100px;
            border: 1px solid #ccc;
        }
    </style>

    @if (isset($message))
        <h1>Hasil Deteksi Warna Kulit</h1>
        <pre>{{ print_r($message, true) }}</pre>
        <p>Berdasarkan hasil rekomendasi berikut warna foundationnya</p>
        <div style="display: flex; padding-bottom:20px">
            @foreach ($foundationImage as $image)
            <?php
            // Mendapatkan nama file tanpa ekstensi
            $fileName = pathinfo($image, PATHINFO_FILENAME);
            ?>
            <div class="image-item" width="50px;" height="50px" style="margin-right: 20px; ">
                    <img src="{{ $image }}" alt="{{ $image }}" class="foundation-img"
                        style="border-radius: 25px; width: 50px; height: 50px;">
                        <p>{{ $fileName }}</p>
                </div>
            @endforeach
        </div>

        @php
            $foundationImages = isset($foundationImages) ? $foundationImages : [];
            // dd($foundationImage)
        @endphp

        {{-- @if (!empty($foundationImages))
            <h2>Rekomendasi Foundation</h2>
            <div class="foundation-images">
                @dd($foundationImages)
                @foreach ($foundationImages as $foundationImage)
                    <img src="{{ $foundationImage }}" alt="Rekomendasi Foundation">
                @endforeach
            </div>
        @endif --}}

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @else
        <p>No response data available.</p>
    @endif


    {{-- <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload File</title>
    </head>

    <body>
        <h1>Upload File</h1>
        <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="file" accept="image/*" onchange="previewImage(event)">
            <br><br>
            <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 300px;">
            <br><br>
            <button
                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-white-600 text-black hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                type="submit">Upload</button>
        </form>
        @if (session('message'))
            <pre>{{ print_r($message, true) }}</pre>
        @else
            <p>No response data available.</p>
        @endif

        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('imagePreview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </body> --}}

@endsection

