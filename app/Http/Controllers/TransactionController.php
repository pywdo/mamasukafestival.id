<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::join('users', 'users.id', '=', 'transaction.user_id')
            ->join('courses', 'courses.id', '=', 'transaction.courses_id')
            ->get(['transaction.*', 'users.name as user_name', 'users.email as user_email', 'courses.name as course_name', 'courses.price as course_price']);

        $pageName = 'Transaksi';
        return view('admin.transaction.index', compact('data', 'pageName'));
    }

    public function approval($id, $status)
    {
        $transaction = Transaction::find($id);

        $transaction->update([
            'status' => $status
        ]);

        return redirect()->route('admin.transaction')
            ->with('success', 'Transaksi berhasil disetujui.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pageName = 'Transaksi';
        $data = Courses::find($id);
        return view('home.transaction.create', compact('data', 'pageName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->proof->extension();

        $request->proof->move(public_path('images'), $imageName);

        Transaction::create([
            'courses_id' => $request->id,
            'proof' => $imageName,
            'status' => 0,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home.courses.detail', $request->id)
            ->with('success', 'Kursus sudah dibeli dan menunggu pengecekan oleh admin.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
