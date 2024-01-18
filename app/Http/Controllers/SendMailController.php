<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\SubscriptionDue;
use App\Helpers\BladeCompileHelper;
use App\Models\Membership;
use App\Models\EmailTemplate;

class SendMailController extends Controller
{
    public function send(Request $request, BladeCompileHelper $bladeHelper)
    {
        $id = $request->id;
        $template = EmailTemplate::find($id);
        $mailTo = config('app.admin_mail_to');
        $mailFrom = config('app.mail_from');
        $mailToName = config('app.admin_mail_to_name');

        if (!$template) {
            return back()->with('error', 'No template found');
        }

        // student membership for test data
        $member = Membership::find(1);

        // args for th blade compiler to replace our template vars with data
        $bodyArgs = [
            'student_name' => $member->firstname . ' ' . $member->surname,
            'date_due' => Carbon::parse($member->date_due)->format('d/m/Y'),
            'pay_button' => '<a href="'.config('app.url').'/product-checkout/" class="btn" style="color:#fff;background-color:#0d6efd;">Pay online</a>'
        ];
        $subject = $bladeHelper->compile($template->subject, $bodyArgs);
        $content = $bladeHelper->compile($template->content, $bodyArgs);

        $mailData = [
            'to' => $mailTo,
            'from' => $mailFrom,
            'name' => $mailToName,
            'subject' => $subject,
            'content' => $content
        ];
        $send = Mail::to($mailTo)->send(new SubscriptionDue($mailData));

        if (!$send) {
            return back()->with('error', 'Unable to send message');
        }

        return back()->with('success', 'Successfully sent message');
    }
}
