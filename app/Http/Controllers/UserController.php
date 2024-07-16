<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function ban(User $user)
    {
        $user->update(['banned' => true]);

        return back()->with('success', 'User banned successfully.');
    }

    public function unban(User $user)
    {
        $user->update(['banned' => false]);

        return back()->with('success', 'User unbanned successfully.');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'banned' => 'required|boolean',
        ]);
    
        // Toggle the banned status
    
        return back()->with('success', 'User status updated successfully.');
    }
    public function accept( Reservation $reservation)
    {
        $reservation->update(['validated' => true]);
        return back()->with('success', 'Registration validated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
