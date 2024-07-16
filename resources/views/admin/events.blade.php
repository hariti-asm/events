


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/style.css">
  
    <link rel="stylesheet" href="../css/tooplate-style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/tooplate-style.css">

</head>
<body >
    {{-- <x-section></x-section> --}}
  
 
 

 
 <div class="w-full max-w-[76%] mx-auto ml-[300px] mt-10">
    <table class="w-full max-w-7xl mt-10 mx-auto  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-[#e6f4f1] dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  
                    
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic">
                            Date
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic"">
                         Location
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic"">
                            End Time
                        </p>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <p class="text-lg text-black font-semibold italic"">
                            Approve
                        </p>
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                       
                        <td class="px-6 py-4">
                            <p class="text-md">
                                {{ $event->title }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-md">
                                {{ $event->location }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-md">
                                {{ $event->date_time}}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('events.approve', $event) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-white bg-[#0d9276] text-sm px-2 py-1 rounded focus:outline-none {{ $event->approved ? 'hover:cursor-not-allowed bg-[#79a79d]' : '' }}" {{ $event->approved ? 'disabled' : '' }}>
                                    {{ $event->approved ? 'Approved' : 'Approve' }}
                                </button>
                            </form>
                            
                        </td>
                        
                        
                        
                        
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    </div>
    <script src="../js/script.js"></script>
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
    </script>
    

</body>
</html>