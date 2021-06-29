<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;

use App\Jobs\SendMailJob;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->only('store');
        $this->middleware('admin')->except('store');

    }

    public function index()
    {
        return view('backend.messages.index')->with('messages',Message::paginate(10));

    }


    function fetchDataByAjax(Request $request)
    {

        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $messages = Message::where("name", 'like', '%' . $query . '%')
                ->orwhere('email', 'like', '%' . $query . '%')
                ->orwhere('subject', 'like', '%' . $query . '%')
                ->orwhere('message', 'like', '%' . $query . '%')
                ->orwhere('status', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.messages.fetch-Data-By-Ajax', compact('messages'))->render();
        }
    }


    public function store(StoreMessageRequest $request)
    {
       $message=Message::create($request->only(['name','email','subject','message']));

        dispatch(new SendmailJob($message))->delay(Carbon::now()->addSeconds(5));
       return redirect()->back()->with('success' , 'your message has been sent ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * convert message status from unread to read
     *
     * @param Message $Message
     * @return RedirectResponse
     */
    public function edit(Message $Message)
    {
        $Message->update([
            'status'=>'read'
        ]);
        return redirect()->back();

    }



    public function destroy(Message $Message)
    {
        $message = $Message ;
        $Message->delete();
        return response()->json([
            'message_id'=>$message->id ,
            'count_messages'=>count(Message::all())
        ]);
    }
}
