<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Page;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    $contact = Page::firstOrCreate(['key'=>'contact'], ['title'=>'Contact', 'content'=>[]]);
    return view('site.contact', compact('contact'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'subject' => 'nullable|string|max:255',
      'message' => 'required|string|max:5000',
    ]);

    ContactMessage::create($data);

    return back()->with('success', 'Message sent successfully.');
  }
}
