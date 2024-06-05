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
            });
        });
    </script>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload File</title>
    </head>

    <body>
        <h1>Upload File</h1>
        <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button
                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-white-600 text-black hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                type="submit">Upload</button>
        </form>
    </body>
@endsection
