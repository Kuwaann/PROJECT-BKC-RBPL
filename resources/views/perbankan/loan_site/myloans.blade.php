@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BKC - My Loans</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="{{ asset('css/myloans.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
    @vite('resources/css/app.css')
    <style>
      .menu{
        animation: fadeIn 0.5s ease;
      }
      @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
      }
    </style>
</head>
<body class="bg-gray-50 font-sans mb-20">
  <!-- Header -->
  <div class="flex px-7 py-8 bg-white mb-5 items-center">
    <a class="mr-3 pop" href="{{ route('nasabah.loans') }}">
        <img src="{{ asset('images/arrowblue.png') }}" alt="">
    </a>
    <h1 class="font-extrabold text-3xl text-[#13545C]">My Loans</h1>
  </div>
 <!-- Menu List -->
  @php
    $hitungpengajuan_kredit = $pengajuan_kredit->count();
  @endphp
 <div class="@if($hitungpengajuan_kredit > 0)menu @endif px-6">
  <!-- Loan -->
  @if ($hitungpengajuan_kredit == 0)
    <div class="flex flex-col items-center justify-center py-10">
      <img src="{{ asset('images/emptymailbox-01-01.png') }}" alt="No Notifications" class="w-96 mb-4 opacity-50">
    </div>
  @elseif($hitungpengajuan_kredit > 0)
    @foreach($pengajuan_kredit->sortByDesc('tanggal_pengajuankredit') as $item)
    <a href="{{ route('nasabah.loan', ['id' => $item->id_pengajuankredit]) }}">
      <div class="bg-white border border-gray-300 rounded-[27px] w-full flex items-center py-4 px-6 mb-3 h-30 active:bg-gray-100 transition-all duration-200 ease-in-out">
        <div class="mr-4">
          <img src="{{ asset('images/loan.png') }}" alt="">
        </div>
        <div class="flex flex-col justify-between w-full">
          <p class="text-black font-bold">Loan Application</p>
          <p class="text-black font-normal mb-3">{{ $item->tanggal_pengajuankredit->format('d/m/Y') }}</p>
          <p class="text-black font-normal">{{ $item->status_pengajuankredit }}</p>
        </div>
      </div>
    </a>
    @endforeach
  @endif
</body>
</html>
