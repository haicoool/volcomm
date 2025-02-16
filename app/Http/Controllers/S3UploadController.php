<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class S3UploadController extends Controller
{
    public function getPresignedUrl(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'filetype' => 'required|string',
        ]);

        $filename = $request->input('filename');
        $filetype = $request->input('filetype');

        // Generate a presigned URL
        $disk = Storage::disk('s3');
        $command = $disk->getAdapter()->getClient()->getCommand('PutObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key'    => 'uploads/' . $filename,
            'ContentType' => $filetype,
            'ACL'    => 'public-read', // or 'private' if you want restricted access
        ]);

        $presignedRequest = $disk->getAdapter()->getClient()->createPresignedRequest($command, '+10 minutes');
        $presignedUrl = (string) $presignedRequest->getUri();

        return response()->json(['url' => $presignedUrl]);
    }
}
