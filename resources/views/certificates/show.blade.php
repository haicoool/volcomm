<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $certificate->oppTitle }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f8ff;
        }
        .certificate {
            width: 80%;
            max-width: 800px;
            border: 15px solid #ff69b4;
            padding: 30px;
            background-color: #fff;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }
        .certificate h1 {
            font-size: 3em;
            margin-bottom: 0.5em;
            color: #ff69b4;
        }
        .certificate h2 {
            font-size: 2.5em;
            margin: 0.5em 0;
            color: #ff4500;
        }
        .certificate h3 {
            font-size: 2em;
            margin: 0.5em 0;
            color: #ff8c00;
        }
        .certificate p {
            font-size: 1.5em;
            margin: 0.5em 0;
            color: #4682b4;
        }
        .certificate .logo {
            margin-bottom: 2em;
        }
        .certificate .signature {
            margin-top: 2em;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .certificate .signature img {
            height: 70px;
        }
        .download-button {
            margin-top: 20px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            .download-button {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="certificate">
        <div class="logo">
            <img src="{{ Storage::disk('s3')->url($certificate->logo) }}" alt="Logo" height="100">
        </div>
        <h1>Certificate of Participation</h1>
        <p>This is to certify that</p>
        <h2>{{ $certificate->vName }}</h2>
        <p>has successfully participated in the</p>
        <h3>{{ $certificate->oppTitle }}</h3>
        <p>held on {{ \Carbon\Carbon::parse($certificate->oppDate)->format('F j, Y') }}</p>
        <div class="signature">
            <img src="{{ Storage::disk('s3')->url($certificate->signature) }}" alt="Signature">
            <p>{{ $certificate->signerName }}</p>
            <p>{{ $certificate->signerPosition }}</p>
        </div>
        <div class="download-button">
            <button onclick="downloadCertificate()">Download</button>
        </div>
    </div>

    <script>
        function downloadCertificate() {
            window.print();
        }
    </script>
</body>
</html>
