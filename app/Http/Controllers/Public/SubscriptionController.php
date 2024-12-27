<?php

namespace App\Http\Controllers\Public;

use App\Mail\JobPostMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Public\FreeQuote\JobPostRequest;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('public.pages.subscription.subscription');
    }


    public function jobPost(JobPostRequest $request)
    {
        $email = settings('email');
        $mailData = $request->all();

        try {
            if ($email) {
                Mail::to($email)->send(new JobPostMail($mailData));
            }

            Mail::to(Config('mail.from.address'))->send(new JobPostMail($mailData));

            return back()->with('success', "Thanks for the job posting, We will get back to you soon!");
        } catch (\Throwable $th) {
            return back()->with('failure', "Sorry, Something Went Wrong!.");
        }
    }
}
