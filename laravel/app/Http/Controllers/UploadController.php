<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Storage;
 use Intervention\Image\Facades\Image;
//  use Intervention\Image\ImageManagerStatic as Image;
 class UploadController extends Controller
 {
    // public function upload(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);
    //     // Store the file
    //     $path = $request->file('document')->store('uploads');
    //     // Return a response
    //     return response()->json(['path' => $path], 200);
    // }

    // public function upload(Request $request)
    // {
    //      // Validate the request
    //     $request->validate([
    //         'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);

    //     $file = $request->file('document');

    //     if (!$file) {
    //         return response()->json(['error' => 'No file found in request.'], 400);
    //     }

    //     try {
    //         // Store file to MinIO
    //         $path = Storage::disk('minio')->put('uploads', $file);

    //         if (!$path) {
    //             return response()->json(['error' => 'Failed to upload file.'], 500);
    //         }

    //         $url = Storage::disk('minio')->url($path);

    //         return response()->json([
    //             'path' => $path,
    //             'url' => $url
    //         ], 200);

    //     } catch (\Throwable $e) {
    //         return response()->json([
    //             'error' => 'Exception occurred',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

     public function upload(Request $request)
    {

        $request->validate([
                'document' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $image = $request->file('document');
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('minio')->put(
                'uploads/' . $fileName,
                file_get_contents($image)
            );

            $thumbnail = Image::make($image->getRealPath())
                ->fit(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode();

            Storage::disk('minio')->put(
                'thumbnails/' . $fileName,
                (string) $thumbnail
            );

            return redirect('/upload_file')->with([
                'original_url' => Storage::disk('minio')->url('uploads/' . $fileName),
                'thumbnail_url' => Storage::disk('minio')->url('thumbnails/' . $fileName),
            ]);
    }
        
    
 }