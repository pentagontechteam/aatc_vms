<div class="mx-auto bg-white w-[204px] h-[325px] shadow-xl flex overflow-hidden relative pass-body print:w-[204px] print:h-[325px]">
  <!-- Corner Decorations -->
  <div class="absolute top-0 right-0 w-[18px] h-[18px] border-t-2 border-r-2 border-[#0d9488]"></div>
  <div class="absolute bottom-0 right-0 w-[18px] h-[18px] border-b-2 border-r-2 border-[#0d9488]"></div>

  <!-- Left Sidebar -->
  <div class="bg-[#0d9488] w-10 flex items-center justify-center relative overflow-hidden">
    <div class="transform rotate-180 [writing-mode:vertical-lr] [text-orientation:mixed] text-white font-bold text-lg tracking-wider">
      VISITOR PASS
    </div>
    <!-- Subtle diagonal pattern -->
    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDYwIDYwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJNMzAgMTVMMTUgMzAgMzAgNDUgNDUgMzB6IiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMS41IiBmaWxsPSJub25lIi8+PC9zdmc+')]"></div>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-4 relative flex flex-col">
    <!-- Top Logo -->
    <div class="flex items-center justify-center mb-4">
      <img src="{{ asset('assets/Picture2.jpeg') }}" alt="Top Logo" class="max-w-[100px] h-auto" />
    </div>

    <!-- Content -->
    <div class="p-2 flex-1 flex flex-col z-20 justify-center text-center">
      <!-- Venue Information -->
      <div class="mb-4">
        <div class="text-lg font-bold text-gray-800 mb-2 venue-font">
          Venue:
          <div>{{ $decoded['floor'] ?? '---' }}</div>
          <div>{{ $decoded['wing'] ?? '' }}</div>
        </div>
        <div class="text-lg font-bold text-gray-800 venue-font">
          Pass ID: {{ $decoded['pass_id'] ?? '---' }}
        </div>
      </div>

      <!-- Decorative divider -->
      <div class="w-3/4 h-[2px] bg-gradient-to-r from-transparent via-[#0d9488] to-transparent mx-auto my-3 rounded-full"></div>

      <!-- Important Notice -->
      <div class="text-center z-20">
        <div class="text-sm font-semibold text-gray-800 leading-tight">
          Must be visibly worn at all times while on premises
        </div>
      </div>
    </div>

    <!-- Bottom Logo -->
    <div class="absolute bottom-1 right-1 z-10">
      <img src="{{ asset('assets/Picture-nobg.png') }}" alt="Bottom Logo" class="h-[4rem] opacity-30" />
    </div>

    <!-- Subtle background pattern -->
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDYwIDYwIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJNMzAgMTVMMTUgMzAgMzAgNDUgNDUgMzB6IiBzdHJva2U9IiMwZDk0ODgiIHN0cm9rZS13aWR0aD0iMS41IiBmaWxsPSJub25lIi8+PC9zdmc+')]"></div>
  </div>
</div>