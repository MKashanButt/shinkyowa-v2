<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::with('country')
            ->paginate(8);
        return view("admin.inquiry.index", compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        $previous = Inquiry::where('id', '<', $inquiry->id)->max('id');
        $next = Inquiry::where('id', '>', $inquiry->id)->min('id');

        return view('admin.inquiry.show', [
            'inquiry' => $inquiry,
            'previousId' => $previous,
            'nextId' => $next,
        ]);
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()
            ->back()
            ->with('success', 'Inquiry Deleted');
    }
}
