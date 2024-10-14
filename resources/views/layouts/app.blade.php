<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Tracking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
      .btn {
        @apply text-white bg-purple-600 hover:bg-purple-700 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 px-5 w-full sm:w-auto;
      }
  
      .input {
        @apply bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4;
      }

      .label{
        @apply block mb-2 text-sm font-medium;
      }
  
    </style>
</head>
<body>
    @include('success-message')
      
      @yield('content')
</body>
</html>