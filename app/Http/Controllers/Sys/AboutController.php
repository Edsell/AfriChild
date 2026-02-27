<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function edit()
    {
        $item = AboutPage::firstOrCreate([], [
            'page_title' => 'About Us',
            'is_active'  => 1,
        ]);

        return view('sys.about', compact('item'));
    }

    public function update(Request $request)
    {
        $item = AboutPage::firstOrCreate([], [
            'page_title' => 'About Us',
            'is_active'  => 1,
        ]);

        $data = $request->validate([
            'page_title'        => ['required','string','max:255'],
            'meta_title'        => ['nullable','string','max:255'],
            'meta_description'  => ['nullable','string'],
            'heading'           => ['nullable','string','max:255'],
            'content'           => ['nullable','string'],
            'cta_text'          => ['nullable','string','max:255'],
            'cta_url'           => ['nullable','string','max:255'],
            'is_active'         => ['nullable','boolean'],

            // ✅ image
            'image'             => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // delete old image if exists
            if (!empty($item->image)) {
                $old = str_replace('\\', '/', $item->image);
                $old = ltrim($old, '/');
                $old = preg_replace('#^public/#', '', $old);

                if (file_exists(public_path($old))) {
                    @unlink(public_path($old));
                }
            }

            $data['image'] = $this->storeImage($request);
        }

        $item->update($data);

        return back()->with('success', 'About page updated successfully.');
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $name = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
        $dir  = public_path('uploads/about');

        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $file->move($dir, $name);

        return 'uploads/about/'.$name;
    }
}