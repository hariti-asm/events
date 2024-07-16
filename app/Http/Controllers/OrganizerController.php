<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Http\Requests\EventRequest2;
use App\Http\Requests\ReservationRequest;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $todayReservationCount = Reservation::whereDate('created_at', now()->toDateString())->count();
        $totalIncome = Reservation::sum('total_price');
        $todayIncome = Reservation::whereDate('created_at', now()->toDateString())->sum('total_price');

        return view("organizer.index", compact('todayReservationCount', 'totalIncome', 'todayIncome'));
    }
    public function events()
    {
        $events = Event::all();
        $categories = Category::all();
        return view("organizer.events", compact('events', 'categories'));
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


    public function store(EventRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $validatedData['image'] = $imageName;
        }

        Event::create($validatedData);

        return back()->with('success', 'Event created successfully.');
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

     public function update(EventRequest2 $request, $id)
     {
         $event = Event::findOrFail($id);
     
         $event->update([
             'title' => $request->validated()['title'],
             'description' => $request->validated()['description'],
             'category_id' => $request->validated()['category_id'],
             'price' => $request->validated()['price'],
             'location' => $request->validated()['location'],
             'available_seats' => $request->validated()['available_seats'],
             'date_time' => $request->validated()['date_time'],
         ]);
     
         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imageName = time() . '_' . $image->getClientOriginalName();
             $image->storeAs('public/images', $imageName);
             $event->image = $imageName;
             $event->save();
         }
     
         return back()->with('success', 'Event updated successfully.');
     }
     
     
     
     
     
    public function reservation_type(Request $request, Event $event)
    {
        // dd($event->reservation_type);
        $validatedData = $request->validate([
            'reservation_type' => 'required|in:manual,automatic',
        ]);

        $newReservationType = ($event->reservation_type === 'manual') ? 'automatic' : 'manual';

        $event->update(['reservation_type' => $newReservationType]);

        return back()->with('success', 'Reservation type updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
