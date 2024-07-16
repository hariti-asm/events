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

   <div class="flex justify-center items-center gap-10 mt-24">
    

    <div class="flex items-center justify-center ">
        <div class="bg-white rounded-md shadow-sm p-6 flex flex-col items-center">
            <div class="flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 9a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1zm0 2a1 1 0 100 2h4a1 1 0 100-2H8z" clip-rule="evenodd" />
                </svg>
                <h5 class="text-xs mb-1">Total Income</h5>
            </div>
            <div>
                <p class="text-gray-600 text-xs mb-1">All Events</p>
                <p class="text-green-600 text-sm font-bold mb-0">${{ $totalIncome }}</p>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <div class="bg-white rounded-md shadow-sm p-6 flex flex-col items-center">
            <div class="flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4zM9 3a7 7 0 100 14 7 7 0 000-14zM5 10a5 5 0 1110 0 5 5 0 01-10 0z" clip-rule="evenodd" />
                </svg>
                <h5 class="text-xs mb-1">Today's Reservations</h5>
            </div>
            <div>
                <p class="text-gray-600 text-xs mb-1">{{ now()->toDateString() }}</p>
                <p class="text-blue-600 text-sm font-bold mb-0">{{ $todayReservationCount }}</p>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <div class="bg-white rounded-md shadow-sm p-6 flex flex-col items-center">
            <div class="flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 9a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1zm0 2a1 1 0 100 2h4a1 1 0 100-2H8z" clip-rule="evenodd" />
                </svg>
                <h5 class="text-xs mb-1">Today's Income</h5>
            </div>
            <div>
                <p class="text-gray-600 text-xs mb-1">{{ now()->toDateString() }}</p>
                <p class="text-blue-600 text-sm font-bold mb-0">${{ $todayIncome }}</p>
            </div>
        </div>
    </div>
   </div>
</body>
</html>
