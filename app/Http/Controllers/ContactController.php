<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    /**
     * The ContactRepository instance.
     *
     * @var \App\Repositories\ContactRepository
     */
    protected $contactRepository;

    /**
     * Create a new ContactController instance.
     *
     * @param  \App\Repositories\ContactRepository $contactRepository
     * @return void
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;

        $this->middleware('admin')->except('create', 'store');
        $this->middleware('ajax')->only('update');
    }

    /**
     * Display a listing of the contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->contactRepository->getContactsOrder();

        return view('back.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.contact');
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $this->contactRepository->store($request->all());

        return redirect('/')->with('ok', trans('front/contact.ok'));
    }

    /**
     * Update the specified contact in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->contactRepository->update($request->input('seen'), $id);

        return response()->json();
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->contactRepository->destroy($id);
        
        return redirect('contact');
    }
}
