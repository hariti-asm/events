<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <x-sidebar></x-sidebar>
    <div class="head  float-end mx-auto mr-[2%]">
        <h4>Events</h4>
        <a href="#" data-toggle="modal" data-target="#addeventModal"><i class='bx bx-plus'></i></a>
        <i class='bx bx-filter'></i>
        
    </div>
    <div class="table-data">
        <div class="todo">
            <table class="table-auto w-full max-w-[70%] ml-[25%] mx-auto mt-[5%] ">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Event Name</th>
                        <th class="px-4 py-2">Event date</th>

                        <th class="px-4 py-2">Actions</th>
                        <th class="px-4 py-2">acceptation</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td class="border px-4 py-2">{{ $event->title }}</td>
                        <td class="border px-4 py-2">{{ $event->date_time }}</td>

                        <td class="border px-4 py-2">
                            <a href="#" data-toggle="modal" data-target="#editeventModal{{ $event->id }}" data-event-title="{{ $event->title }}"><i class='bx bx-edit'></i></a>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this event?')) document.getElementById('deleteeventForm{{ $event->id }}').submit();"><i class='bx bx-trash'></i></a>
                            <form id="deleteeventForm{{ $event->id }}" action="{{ route('events.destroy', $event) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                       <td> 
						<form method="POST" action="{{ route('organiser.reservation.update', $event) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="reservation_type" value="{{ $event->reservation_type }}">
                            <button type="submit" class="bg-{{ $event->reservation_type === 'manual' ? 'green' : 'blue' }}-600 text-white text-sm px-4 py-2 rounded">
                                {{ $event->reservation_type === 'manual' ? 'Manually' : 'Automatic' }}
                            </button>
                        </form>
                        
                        
                        
                       </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add Event Modal -->
        <div id="addeventModal" class="modal fixed inset-0 overflow-y-auto hidden" tabindex="-1" aria-labelledby="addeventModalLabel" aria-hidden="true" data-modal-target="addeventModal">
            <!-- Modal dialog -->
            <div class="modal-dialog flex items-center justify-center min-h-screen">
                <div class="modal-content bg-white rounded-lg shadow-lg max-w-md w-full">
                    <div class="modal-header flex justify-between bg-gray-100 py-2 px-4">
                        <h5 class="modal-title text-lg font-semibold" id="addeventModalLabel">Add Event</h5>
                        <button type="button" class="btn-close" data-modal-hide="addeventModal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Form for adding an event -->
                        <form action="{{ route('organiser.events.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" accept-charset="UTF-8">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="font-semibold text-sm">Event Name:</label>
                                <input type="text" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="name" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="font-semibold text-sm">Description:</label>
                                <textarea class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date_time" class="font-semibold text-sm">Date and Time:</label>
                                <input type="datetime-local" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="date_time" name="date_time">
                            </div>
                            <div class="form-group">
                                <label for="location" class="font-semibold text-sm">Location:</label>
                                <input type="text" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="location" name="location">
                            </div>
                            <div class="form-group">
                                <label for="category_id" class="font-semibold text-sm">Category:</label>
                                <select class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="category_id" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="available_seats" class="font-semibold text-sm">Available Seats:</label>
                                <input type="number" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="available_seats" name="available_seats">
                            </div>
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
                            <div class="form-group">
                                <label for="reservation_type" class="font-semibold text-sm">Reservation Type:</label>
                                <div class="flex items-center mt-2">
                                    <input type="radio" id="manual_reservation" name="reservation_type" value="manual" class="mr-2">
                                    <label for="manual_reservation" class="mr-4">Manual</label>
                                    <input type="radio" id="automatic_reservation" name="reservation_type" value="automatic" class="mr-2">
                                    <label for="automatic_reservation">Automatic</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="price" class="font-semibold text-sm ">Price:</label>
                                <input type="text" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="reservation_type" name="price">
                            </div>
                            <div class="form-group">
                                <label for="image" class="font-semibold text-sm">Image:</label>
                                <input type="file" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="image" name="image">
                            </div>
                            
                            <button type="submit" class="bg-[#4F46E5] text-white font-semibold text-md px-3 py-1 rounded-full w-full max-w-sm">Add Event</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($events as $event)
    <div id="editeventModal{{ $event->id }}" class="modal fixed inset-0 overflow-y-auto hidden" tabindex="-1" aria-labelledby="editeventModalLabel{{ $event->id }}" aria-hidden="true" data-modal-target="editeventModal{{ $event->id }}">
        <div class="modal-dialog flex items-center justify-center min-h-screen">
            <div class="modal-content bg-white rounded-lg shadow-lg max-w-md w-full">
                <div class="modal-header flex justify-between bg-gray-100 py-2 px-4">
                    <h5 class="modal-title text-lg font-semibold" id="editeventModalLabel{{ $event->id }}">Edit Event</h5>
                    <button type="button" class="btn-close" data-modal-hide="editeventModal{{ $event->id }}" aria-label="Close">X</button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('organiser.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">

                        <div class="form-group">
                            <label for="title" class="font-semibold">Event Title:</label>
                            <input type="text" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="title" name="title" value="{{ $event->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-semibold">Event Description:</label>
                            <textarea class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="description" name="description" required>{{ $event->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category" class="font-semibold">Event Category:</label>
                            <select class="form-select border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="category" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $event->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="price" class="font-semibold">Event Price:</label>
                            <input type="number" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="price" name="price" value="{{ $event->price }}" required>
                        </div>
                    <div class="form-group">
                            <label for="available_seats" class="font-semibold">Available Seats:</label>
                            <input type="number" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="available_seats" name="available_seats" value="{{ $event->available_seats }}" required>
                        </div>
                        <div class="form-group">
                            <label for="location" class="font-semibold">Event Location:</label>
                            <input type="text" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="location" name="location" value="{{ $event->location }}" required>
                        </div>
                        <div class="form-group">
                            <label for="date_time" class="font-semibold">Event Date and Time:</label>
                            <input type="datetime-local" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="date_time" name="date_time" value="{{ date('Y-m-d\TH:i', strtotime($event->date_time)) }}" required>
                        </div> 
                        <div class="form-group">
                            <label for="image" class="font-semibold">Event Image:</label>
                            <input type="file" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="image" name="image">
                            <img src="{{ asset('storage/images/' . $event->image) }}" alt="Event Image" class="img-fluid mt-2" style="max-height: 200px;">
                        </div>
                        <button type="submit" class="bg-[#99BC85] text-white font-semibold text-md px-3 py-1 rounded-full w-full max-w-sm">Update Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @endforeach
    
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
           const modalToggles = document.querySelectorAll("[data-modal-toggle]");
           const modalCloses = document.querySelectorAll("[data-modal-hide]");
   
           modalToggles.forEach((toggle) => {
               toggle.addEventListener("click", () => {
                   const target = toggle.getAttribute("data-modal-target");
                   const modal = document.getElementById(target);
                   modal.classList.toggle("hidden");
                   modal.setAttribute("aria-hidden", modal.classList.contains("hidden"));
               });
           });
   
           modalCloses.forEach((close) => {
               close.addEventListener("click", () => {
                   const target = close.getAttribute("data-modal-hide");
                   const modal = document.getElementById(target);
                   modal.classList.add("hidden");
                   modal.setAttribute("aria-hidden", modal.classList.contains("hidden"));
               });
           });
       });
      
           const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
   
   allSideMenu.forEach(item=> {
       const li = item.parentElement;
   
       item.addEventListener('click', function () {
           allSideMenu.forEach(i=> {
               i.parentElement.classList.remove('active');
           })
           li.classList.add('active');
       })
   });
   
   // TOGGLE SIDEBAR
   const menuBar = document.querySelector('#content nav .bx.bx-menu');
   const sidebar = document.getElementById('sidebar');
   
   menuBar.addEventListener('click', function () {
       sidebar.classList.toggle('hide');
   })
   
   
   
   
   
   
   
   const searchButton = document.querySelector('#content nav form .form-input button');
   const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
   const searchForm = document.querySelector('#content nav form');
   
   searchButton.addEventListener('click', function (e) {
       if(window.innerWidth < 576) {
           e.preventDefault();
           searchForm.classList.toggle('show');
           if(searchForm.classList.contains('show')) {
               searchButtonIcon.classList.replace('bx-search', 'bx-x');
           } else {
               searchButtonIcon.classList.replace('bx-x', 'bx-search');
           }
       }
   })
   
   
   
   
   
   if(window.innerWidth < 768) {
       sidebar.classList.add('hide');
   } else if(window.innerWidth > 576) {
       searchButtonIcon.classList.replace('bx-x', 'bx-search');
       searchForm.classList.remove('show');
   }
   
   
   window.addEventListener('resize', function () {
       if(this.innerWidth > 576) {
           searchButtonIcon.classList.replace('bx-x', 'bx-search');
           searchForm.classList.remove('show');
       }
   })
   
   
   
   const switchMode = document.getElementById('switch-mode');
   
   switchMode.addEventListener('change', function () {
       if(this.checked) {
           document.body.classList.add('dark');
       } else {
           document.body.classList.remove('dark');
       }
   })
       </script>
</body>
</html>