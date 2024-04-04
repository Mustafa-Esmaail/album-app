<?php

namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('pictures')->get();

        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }
public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $album = Album::create($request->only('name'));

        if ($request->hasFile('pictures')) {
            $i=0;
            foreach ($request->file('pictures') as $picture) {

                $folder = 'album_' . $album->name.'/pictures';
                $filename = $request->input('picture_name')[$i] . '.' . $picture->getClientOriginalExtension(); // Replace with your desired filename or dynamic value

                if (!File::exists(public_path($folder))) {
                    File::makeDirectory(public_path($folder), 0777, true, true);
                }
                // Save the uploaded picture
                 $picture->move(public_path($folder ), $filename);


                $img=Picture::create([
                    'album_id'=>$album->id,
                    'name'=>$request->input('picture_name')[$i],
                    'path'=> $folder.'/'.$filename,
                ]);
                $i++;
            }
        }

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $album->update($request->only('name'));

        if ($request->hasFile('pictures')) {
            $i=0;
            foreach ($request->file('pictures') as $picture) {

                $folder = 'album_' . $album->name.'/pictures';
                $filename = $request->input('picture_name')[$i] . '.' . $picture->getClientOriginalExtension(); // Replace with your desired filename or dynamic value

                if (!File::exists(public_path($folder))) {
                    File::makeDirectory(public_path($folder), 0777, true, true);
                }
                // Save the uploaded picture
                 $picture->move(public_path($folder ), $filename);


                $img=Picture::create([
                    'album_id'=>$album->id,
                    'name'=>$request->input('picture_name')[$i],
                    'path'=> $folder.'/'.$filename,
                ]);
                $i++;
            }
        }

        return redirect()->route('albums.index');
    }

    public function delete(Album $album)
    {
        $others= Album::where('id', '!=', $album->id)->get();
        return view('albums.delete', compact('album','others'));

    }

    public function deleteAlbum(Request $request, Album $album)
    {


        $delete_media = $request->input('delete_media');


        if ( $delete_media== 1) {
            foreach ($album->pictures as $picture) {
                $picture->delete();
            }
            $album->delete();
        }
        else{
            $new=Album::find($request->input('new_album_id'));
            foreach ($album->pictures as $picture) {
                $picture->update([
                    'album_id'=>$new->id,
                ]);
            }
            $album->delete();
        }

        return redirect()->route('albums.index')->with('success', 'Album Delete successfully.');
    }
}
