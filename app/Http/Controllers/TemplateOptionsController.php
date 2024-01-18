<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateOption;

class TemplateOptionsController extends Controller
{
    public function create(Request $request)
    {
        // validate the request
        $validatedData = $request->validate([
            'option' => ['required', 'string', 'max:255'],
        ], [
            'option.required' => 'Option value field is required.',
        ]);

        $option = new TemplateOption;
        $option->template = $request->id;
        $option->value = $validatedData['option'];
        $option->save();

        return back()->with('success', 'Successfully saved option');
    }
}
