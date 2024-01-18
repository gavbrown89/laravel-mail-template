<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    /**
     * update the email content data
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        // validate the request
        $validatedData = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ], [
            'subject.required' => 'Subject field is required.',
            'content.required' => 'Content field is required.',
        ]);
        // update the template
        $template = EmailTemplate::find($request->id);
        $template->subject = $validatedData['subject'];
        $template->content = $validatedData['content'];
        $template->save();

        return \Session::flash('success', __('Successfully saved the template'));
    }
}
