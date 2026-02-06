<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
  public function index()
  {
    $messages = ContactMessage::latest()->paginate(15);
    return view('sys.contact.index', compact('messages'));
  }

  public function show(ContactMessage $message)
  {
    $message->update(['is_read' => true]);
    return view('sys.contact.show', compact('message'));
  }

  public function destroy(ContactMessage $message)
  {
    $message->delete();
    return back()->with('success', 'Message deleted.');
  }
}
