<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //dd($request->page);

        $request->validate([
            "filter_domain" => "nullable|string"
        ]);

        if ($request->has("filter_domain")) {
            $domains = Domain::where("domain", "LIKE", "%" . $request->filter_domain . "%")
                ->with(["adsense", "analytic"])->paginate(10);
        } else {
            $domains = Domain::with(["adsense", "analytic"])->paginate(10);
        }

        return view('welcome', compact('domains'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return redirect()
        //     ->action('Back\CategoriesController@index')
        //     ->with(['success' => $messages]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {
        //
    }

    public function getDomains(Request $request)
    {
        $domains = Domain::all();

        return response()->json(['status' => 1, 'domains' => $domains]);
    }
}
