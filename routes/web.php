<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

function buildFilename($document) {
    $name = $document->getClientOriginalName();
    $extension = $document->getClientOriginalExtension();

    $fileName = time() . '_'. str_replace($extension, '', $name);

    return str_slug($fileName, '_') .'.'. $extension;
}

$router->get('/', function () use ($router) {
    return view('app');
});

$router->get('/files', function () {
    $files = [];
    $fileList = Storage::files('public');
    foreach($fileList as $file) {
        $time = Storage::lastModified($file);
        $mimetype = Storage::mimeType($file);
        $fileName = str_replace('public/', '', $file);
        $files[] = [
            'name' => $fileName,
            'link' => URL::asset('storage/'.$fileName),
            'key' => $time,
            'type' => $mimetype,
        ];
    }
    return response()->json($files);
});

$router->post('/upload', function (Request $request) {
    if (!$request->hasFile('file') || !$request->file('file')->IsValid()) {
        return response()->json(['success' => false]);
    }

    $doc = $request->file('file');
    $name = buildFilename($doc);
    $mimetype = $doc->getClientMimeType();
    $doc->storeAs('public', $name); 

    return response()->json([
        'name' => $name,
        'key' => time(),
        'link' => URL::asset('storage/'.$name),
        'type' => $mimetype,
        'success' => true,
    ]);
});

$router->post('/remove', function (Request $request) {
    $fileName = 'public/' . $request->input('file');
    $key = $request->input('key');

    if(!Storage::exists($fileName)) {
        return response('File not found', 404);
    }

    if(Storage::lastModified($fileName) !== (int)$key) {
        return response('File key does not match.', 403);
    }

    Storage::delete($fileName);
    return response()->json(['success' => true]);
});

