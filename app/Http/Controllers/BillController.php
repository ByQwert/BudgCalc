<?php

namespace App\Http\Controllers;

use App\Http\Middleware\OwnerMiddleware;
use App\Http\Requests\CreateBillRequest;
use App\Models\Bill;
use App\Models\Tag;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{

    public function __construct() {
        $this->middleware(OwnerMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $bills = User::find($user_id)->bills()->get();
        $totalSum = User::find($user_id)->totalSum();
        return view('public.bills.index', [
            'bills' => $bills,
            'billCounter' => 0,
            'totalSum' => $totalSum,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('public.bills.create', [
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateBillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBillRequest $request)
    {
        $bill = Bill::create([
            'date' => $request->get('date'),
            'sum' => $request->get('sum'),
            'tag_id' => $request->get('tag'),
            'user_id' => Auth::user()->id
        ]);

        if (!$bill) {
            return redirect()->back();
        }

        $request->session()->flash('flash_message', 'Bill saved');
        return redirect()->route('bills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        return view('public.bills.show', [
            'bill' => $bill
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $tags = Tag::all();

        return view('public.bills.edit', [
            'bill' => $bill,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateBillRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBillRequest $request, $id)
    {
        $bill = Bill::findOrFail($id);

        $bill->fill([
            'date' => $request->get('date'),
            'sum' => $request->get('sum'),
            'tag_id'=> $request->get('tag')
        ]);

        if (!$bill->save()) {
            return redirect()->back()->withErrors('Update error');
        }

        $request->session()->flash('flash.message', 'Bill updated');
        return redirect()->route('bills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return response()->json($bill);

//        if(!$bill->delete()) {
//            return redirect()->back()->withErrors('Delete error');
//        }

//        session()->flash('flash_message', 'Bill deleted');
//        return redirect()->back();
    }
}
