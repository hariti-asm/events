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
<section class="bg-indigo-600 text-white py-8 px-4">
<form method="POST" class=" text-end mb-10" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="bg-white px-3 py-2 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
            
        </form>
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div class="md:w-1/2 mb-10 md:mb-0">
            <h2 class="text-4xl font-bold leading-tight mb-4">Welcome to Our Site</h2>
            <p class="text-xl mb-4">We offer a range of services to help you achieve your goals.</p>
            <button class="bg-white text-indigo-600 font-bold py-3 px-6 rounded hover:bg-indigo-600 hover:text-white">Get Started</button>
        </div>
      
        <div class="md:w-1/2 ">
            <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713" alt="Hero Image" class="w-full rounded-xl">
        </div>
    </div>
</section>
    <form action="{{ route('filter.events') }}" method="GET" class="flex flex-col w-full max-w-[50%] mx-auto md:flex-row gap-3 mt-8">
        <select id="category" name="category" class="w-full h-10 border-2 border-blue-500 focus:outline-none focus:border-blue-600 text-blue-600 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
            <option value="All" selected>All</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white rounded-r px-2 md:px-3 py-0 md:py-1">Filter</button>

    </form>
    
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
            @foreach($events as $event)
            <div class="rounded overflow-hidden shadow-lg">
                <a href="#"></a>
                <div class="relative">
                    <a href="{{route('event_detail',['event'=>$event])}}">
                        <img class="w-full" src="{{ asset('storage/images/' . $event->image) }}" alt="{{ $event->title }}">
                        <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    </a>
                    <a href="{{route('event_detail',['event'=>$event])}}">
                        <div class="absolute bottom-0 left-0 bg-indigo-600 px-4 py-2 text-white text-sm hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                           Book
                        </div>
                    </a>
                    <a href="{{route('event_detail',['event'=>$event])}}">
                        <div class="text-sm absolute top-0 right-0 bg-indigo-600 px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            <span class="font-bold">{{\Carbon\Carbon::parse($event->date_time)->format('d F')
                            }}</span>
                            <small>{{ $event->month }}</small>
                        </div>
                    </a>
            </div>
                <div class="px-6 py-4">
                    <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">{{ $event->title }}</a>
                    <p class="text-gray-500 text-sm">{{ $event->description }}</p>
                </div>
                <div class="px-6 py-4 flex flex-row items-center">
                    <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                        <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="ml-1">
                            @php
                                $dateTime = \Carbon\Carbon::parse($event->date_time);
                                $daysDifference = $dateTime->diffInDays(now(), false);
                            @endphp
                            @if ($daysDifference > 0)
                                {{ $daysDifference }} day{{ $daysDifference > 1 ? 's' : '' }} ago
                            @elseif ($daysDifference == 0)
                                Today
                            @else
                                {{ abs($daysDifference) }} day{{ abs($daysDifference) > 1 ? 's' : '' }} left
                            @endif
                        </span>
                        
                        </span>
                </div>
            </div>
            @endforeach
            <div class="flex justify-center  my-4">
                {{ $events->links() }}
            </div>

        </div>
    </div>
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <p class=" mt-[-12%] mx-auto  text-center italic font-bold text-xl">filtered events</p>
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
            @foreach($events_filter as $event)
            <div class="rounded overflow-hidden shadow-lg">
                <a href="#"></a>
                <div class="relative">
                    <a href="{{route('event_detail',['event'=>$event])}}">
                        <img class="w-full" src="{{ asset('storage/images/' . $event->image) }}" alt="{{ $event->title }}">
                        <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    </a>
                    <a href="{{route('event_detail',['event'=>$event])}}">
                        <div class="absolute bottom-0 left-0 bg-indigo-600 px-4 py-2 text-white text-sm hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                           Book
                        </div>
                    </a>
                    <a href="{{route('event_detail',['event'=>$event])}}">
                        <div class="text-sm absolute top-0 right-0 bg-indigo-600 px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                            <span class="font-bold">{{\Carbon\Carbon::parse($event->date_time)->format('d F')
                            }}</span>
                            <small>{{ $event->month }}</small>
                        </div>
                    </a>
            </div>
                <div class="px-6 py-4">
                    <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">{{ $event->title }}</a>
                    <p class="text-gray-500 text-sm">{{ $event->description }}</p>
                </div>
                <div class="px-6 py-4 flex flex-row items-center">
                    <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                        <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="ml-1">
                            @php
                                $dateTime = \Carbon\Carbon::parse($event->date_time);
                                $daysDifference = $dateTime->diffInDays(now(), false);
                            @endphp
                            @if ($daysDifference > 0)
                                {{ $daysDifference }} day{{ $daysDifference > 1 ? 's' : '' }} ago
                            @elseif ($daysDifference == 0)
                                Today
                            @else
                                {{ abs($daysDifference) }} day{{ abs($daysDifference) > 1 ? 's' : '' }} left
                            @endif
                        </span>
                        
                        </span>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <footer class="mt-20 xl:mt-32 mx-auto w-full relative text-center bg-blue-600 text-white">
        <div class="px-6 py-8 md:py-14 xl:pt-20 xl:pb-12">
            <h2 class="font-bold text-3xl xl:text-4xl leading-snug">
                Ready to get your productivity back?<br>Start your free trial today.
            </h2>
            <a class="mt-8 xl:mt-12 px-12 py-5 text-lg font-medium leading-tight inline-block bg-blue-800 rounded-full shadow-xl border border-transparent hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-sky-999 focus:ring-sky-500"
                href="#">Get
                started</a>
            <div class="mt-14 xl:mt-20">
                <nav class="flex flex-wrap justify-center text-lg font-medium">
                    <div class="px-5 py-2"><a href="#">Contact</a></div>
                    <div class="px-5 py-2"><a href="#">Pricing</a></div>
                    <div class="px-5 py-2"><a href="#">Privacy</a></div>
                    <div class="px-5 py-2"><a href="#">Terms</a></div>
                    <div class="px-5 py-2"><a href="#">Twitter</a></div>
                </nav>
                <p class="mt-7 text-base">© 2023 XYZ, LLC</p>
            </div>
        </div>
    </footer>
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