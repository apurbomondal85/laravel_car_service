<?php

namespace App\Http\Controllers\Public;

use App\Mail\ContactMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Public\Contact\ContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public.pages.contact.index');
    }

    public function newContact(ContactRequest $request)
    {
        $email = settings('email');
        $requestData = $request->all();
        $mailData = $requestData;
        $mailData['subject'] = 'Contact Us';
        try {
            if ($email) {
                Mail::to($email)->send(new ContactMail($mailData));
            }

            Mail::to(Config('mail.from.address'))->send(new ContactMail($mailData));

            $notification = [
                'message'    => 'Your mail is send successfully....!!',
                'alert-type' => 'success'
            ];

            return back()->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'    => 'Sorry, Something Went Wrong....!!',
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }
    }
}
