<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $mediaFiles = Media::latest()->paginate(12);
        return view('admin.media.index', compact('mediaFiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:5120', // up to 5MB
        ]);

        $path = $request->file('file')->store('media', 'public');

        Media::create([
            'file_path' => $path,
            'type' => $request->file('file')->getMimeType(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function destroy(Media $media)
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
