<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Reservation;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        $categories = Category::all();

        return view('admin.events', compact('events', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }




    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }
    public function event_detail(Event $event)
    {
        $event = Event::where('id', $event->id)->first();
        // dd($event->organizer);
        return view('client.event_detail', compact('event'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(EventRequest $request, Event $event)
    {
        $event->update(['approved' => true]);

        return back()->with('success', 'Event approved successfully.');
    }
    public function book(Event $event, Request $request)
    {
        $user = auth()->user();
        $numberOfTickets = $request->input('ticket_quantity');
        $totalPrice = $numberOfTickets * $event->price;
        Reservation::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'number_of_tickets' => $numberOfTickets,
            'total_price' => $totalPrice,
        ]);
// if($event->reservation_type=='manual')
        return redirect()->route('ticket', compact('event'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully');
    }





}
