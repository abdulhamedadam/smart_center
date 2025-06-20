<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Http\Resources\ContactMessageResource;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return ContactMessageResource::collection($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'status' => 'nullable|integer'
        ]);

        $message = ContactMessage::create($validated);
        return new ContactMessageResource($message);
    }

    public function show(ContactMessage $contactMessage)
    {
        return new ContactMessageResource($contactMessage);
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'message' => 'sometimes|string',
            'status' => 'nullable|integer'
        ]);

        $contactMessage->update($validated);
        return new ContactMessageResource($contactMessage);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return response()->json(['message' => 'Contact message deleted successfully']);
    }
} 