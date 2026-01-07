<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('user.contact.contact');
    }

    public function send(ContactRequest $request): RedirectResponse
    {
        try {
            Mail::send(
                'user.emails.contact',
                ['data' => $request->validated()],
                function ($message) use ($request) {
                    $message->to(config('mail.contact_email', 'desaadatarjasa@gmail.com'))
                        ->subject('Pesan Baru: ' . $request->subject)
                        ->replyTo($request->email, $request->name);
                }
            );

            return back()->with('success', __('Message sent successfully!'));
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            return back()
                ->with('error', __('Failed to send message. Please try again.'))
                ->withInput();
        }
    }
}
