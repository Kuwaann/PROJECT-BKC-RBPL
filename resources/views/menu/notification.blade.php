<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bank BKC</title>
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans mb-20">
  <!-- Header -->
  <div class="flex px-7 py-8 bg-white mb-5 items-center">
    <a class="mr-3" href="{{ route('nasabah.homepage') }}">
        <img src="{{ asset('images/arrowblue.png') }}" alt="">
    </a>
    <h1 class="font-extrabold text-3xl text-[#13545C]">Notifications</h1>
  </div>
  <!-- Nantinya notifikasi ini dijadiin komponen dan ngambil dari tabel database namanya Notification -->
  <!-- Notification List -->
  <div class="notifications px-6">
    <!-- Notification 1 -->
    <a href="">
      <div class="bg-white rounded-[27px] w-full flex items-center py-2 px-6 mb-5">
        <div class="w-20 h-20 flex items-center mr-5">
            <img src="{{ asset('images/transfer.png') }}" alt="">
        </div>
        <div class="flex flex-col">
            <p class="text-[16px] font-semibold">Transfer</p>
            <p class="text-[16px] font-light text-justify">You’ve received Rp 16.000 from Et************.</p>
        </div>
      </div>

    <!-- NEW -->
      <div class="bg-[#FF8888] w-full h-1 rounded-sm flex justify-center mb-7">
          <div class="bg-[#FF8888] w-1/2 h-4 rounded-bl-lg rounded-br-lg flex justify-center items-center text-white font-semibold">NEW</div>
      </div>
    </a>

    <!-- Notification 2 -->
    <a href="">
      <div class="bg-white rounded-[27px] w-full flex items-center py-2 px-6 mb-5">
        <div class="w-20 h-20 flex items-center mr-5">
            <img src="{{ asset('images/loan.png') }}" alt="">
        </div>
        <div class="flex flex-col">
            <p class="text-[16px] font-semibold">Loan</p>
            <p class="text-[16px] font-light text-justify">Loan application status has been updated. Click for more info.</p>
        </div>
      </div>
    </a>
  </div>
</body>
</html>