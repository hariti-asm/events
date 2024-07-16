<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative">
        <img src="{{ asset('storage/images/' . $event->image) }}" class="object-cover w-full h-64 md:h-96 lg:h-120 xl:h-144" alt="{{ $event->title }}">
    
        <div class="max-w-3xl mx-auto">
            <div class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                <div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
                  <div class="flex justify-between items-center mb-5">
                    <h1 class="text-gray-900 font-bold text-3xl">{{ $event->title }}</h1>
                    <form action="{{ route('booking.store',['event'=>$event]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="ticket_quantity" value="1"> 
                    
                        <button type="submit" class="mt-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline 
                        {{ \Carbon\Carbon::parse($event->date_time)->isPast() ? 'disabled cursor-not-allowed bg-blue-200' : '' }}">
                        Book Now
                    </button>
                    

                    </form>
                    
                    <div class="flex flex-col">
                        <p class="text-gray-700 text-xs mb-2">Available Seats: {{ $event->available_seats - $event->reservations()->sum('number_of_tickets') }}</p>
                        <label for="ticket_quantity" class="block text-sm font-medium text-gray-700">Number of Tickets:</label>
                        <input type="number" id="ticket_quantity" name="ticket_quantity" min="1" max="{{ $event->available_seats }}" class="w-20 border-green-500 rounded-md shadow-sm focus:ring focus:green-500 focus:ring-opacity-50">
                        <div class="flex gap-4">


                            <span>    Price:</span> <p class="text-[15px] font-bold">${{ $event->price }}</p>

                        </div>

                    </div>
                </div>
                <div class=" flex gap-2 text-gray-700 text-xs mt-2">Written By:
                    <a href="#" class="text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                        {{ $event->organizer->name }}
                    </a>
                    In
                    <a href="#" class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                        {{ $event->category->name }}
                    </a>
                </div>
                
                
                
                    <p class="text-base leading-8 my-5">
                        {{ $event->description }}
                    </p>
    
                    <h3 class="text-2xl font-bold my-5">#1. What is Lorem Ipsum?</h3>
    
                    <p class="text-base leading-8 my-5">
                        {{ $event->description }}
                    </p>
    
                    <blockquote class="border-l-4 text-base italic leading-8 my-5 p-5 text-indigo-600">
                        {{ $event->description }}
                    </blockquote>
    
                    <p class="text-base leading-8 my-5">
                        {{ $event->description }}
                    </p>
    
                    <div class="flex flex-wrap mt-5">
                        <a href="#" class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out mr-2">
                            #Election
                        </a>
                        <a href="#" class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out mr-2">
                            #people
                        </a>
                        <a href="#" class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out mr-2">
                            #Election2020
                        </a>
                        <a href="#" class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out mr-2">
                            #trump
                        </a>
                        <a href="#" class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out mr-2">
                            #Joe
                        </a>
                    </div>
    
                   
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>