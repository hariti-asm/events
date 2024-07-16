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
		
	
		<main>
			
			

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $categoriesNumber?></h3>
						<p>Categories</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $clientsNumber?></h3>
						<p>clientss</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?php echo $organizersNumber?></h3>
						<p>Organizers</p>
					</span>
				</li>
			</ul>

<div class="table-data">
    <div class="order">
        <div class="head">
            <h4>Recent organizers</h4>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Engaging Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizers as $organizer)
                <tr>
                    <td>
                        <img 
						 src="{{ asset('storage/images/' . $organizer->image) }}"
						>
						
                        <p class="text-sm">{{ $organizer->name }}</p>
                    </td>
                    <td class="text-sm">{{ $organizer->created_at->format('d-m-Y') }}</td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
	<div class="todo">
		<div class="head">
			<h4>categories</h4>
			<a href="#" data-toggle="modal" data-target="#addcategoryModal"><i class='bx bx-plus'></i></a>
			<i class='bx bx-filter'></i>
		</div>
		<ul class="todo-list">
			@foreach($categories as $category)
			<li>
				<p class="text-[14px]">{{ $category->name }}</p>
				<div>
					<a href="#" data-toggle="modal" data-target="#editcategoryModal{{ $category->id }}" data-category-name="{{ $category->name }}"><i class='bx bx-edit'></i></a>
					<a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) document.getElementById('deletecategoryForm{{ $category->id }}').submit();"><i class='bx bx-trash'></i></a>
					<form id="deletecategoryForm{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST" style="display: none;">
						@csrf
						@method('DELETE')
					</form>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
	
<!-- Add category Modal (closed by default) -->
<div id="addcategoryModal" class="modal fixed inset-0 overflow-y-auto hidden" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true" data-modal-target="addcategoryModal">
    <div class="modal-dialog flex items-center justify-center min-h-screen">
        <div class="modal-content bg-white rounded-lg shadow-lg max-w-md w-full">
            <div class="modal-header flex justify-between bg-gray-100 py-2 px-4">
                <h5 class="modal-title text-lg font-semibold" id="addcategoryModalLabel">Add category</h5>
                <button type="button" class="btn-close" data-modal-hide="addcategoryModal" aria-label="Close">X</button>
            </div>
            <div class="modal-body p-4">
                <!-- Form for adding a category -->
				{{--  --}}
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="font-semibold">category Name:</label>
                        <input type="text" class="form-input border border-[#DBE7C9] px-2 py-2 rounded-xl focus:outline-none" id="name" name="name" required>
                    </div>
                    <button type="submit" class="bg-[#99BC85] text-white font-semibold text-md px-3 py-1 rounded-full w-full max-w-sm">Add category</button>
                </form>
            </div>
        </div>
    </div>
</div>


	
@foreach($categories as $category)
<!-- Edit category Modal -->
<div class="modal fade hidden" id="editcategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editcategoryModalLabel{{ $category->id }}" aria-hidden="true" data-modal-target="editcategoryModal{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcategoryModalLabel{{ $category->id }}">Edit category</h5>
                <button type="button" class="close" data-modal-hide="editcategoryModal{{ $category->id }}" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">category Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update category</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endforeach	
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
                modal.classList.remove("hidden");
                modal.setAttribute("aria-hidden", "false");
            });
        });

        modalCloses.forEach((close) => {
            close.addEventListener("click", () => {
                const target = close.getAttribute("data-modal-hide");
                const modal = document.getElementById(target);
                modal.classList.add("hidden");
                modal.setAttribute("aria-hidden", "true");
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