<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

	<title>Evento</title>
</head>
<body>

    <x-sidebar></x-sidebar>




	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>


<div class="table-data">
    <div class="order">
        <div class="head">
            <h4 class="font-semibold text-xl">Recent clients</h4>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
		<table class="w-full max-w-7xl mt-10 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-[#e6f4f1] dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic">Event</p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic">User</p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic">Action</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <p class="text-md">{{ $reservation->event->title }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-md">{{ $reservation->user->name }}</p>
                    </td>
                        <td class="px-6 py-4 flex gap-2">
                            {{--  --}}
                            <form method="POST" action="{{ route('organiser.reservations.accept', $reservation) }}">
                                @csrf
                                @method('PUT')
                                @if($reservation->validated)
                                    <span class="text-green-700 text-sm">Accepted</span>
                                @else
                                    <button type="submit" class="text-white bg-blue-700 text-sm px-2 py-1 rounded focus:outline-none">Accept</button>
                                @endif
                            </form>
                            
                            @if(!$reservation->validated)
                                <form method="POST" action="{{ route('organiser.reservation.delete', $reservation) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 text-sm px-2 py-1 rounded focus:outline-none">Refuse</button>
                                </form>
                            @endif
                            
                        </td>
               
                    
                </tr>
                @endforeach
    </div>



	
{{-- edit --}}
	
</div>


		</main>
	</section>
	

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