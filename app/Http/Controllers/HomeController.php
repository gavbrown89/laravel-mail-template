<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\TemplateOption;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('home', compact('templates'));
    }

    /**
     * Show the template form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function templateIndex($id)
    {
        $template = EmailTemplate::find($id);
        $options = TemplateOption::where('template', $id)->get();
        return view('template/index', compact('template', 'options'));
    }

    /**
     * Show the option values form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function optionsIndex($id)
    {
        $template = EmailTemplate::where('id', $id)->first();
        return view('template/options', compact('template'));
    }
}
