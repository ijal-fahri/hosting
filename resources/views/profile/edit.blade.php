<style>
  /* Tambahan animasi halus */
  .fade-in {
      animation: fadeIn 0.5s ease-in-out;
  }

  @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
  }

  /* Hover card effect */
  .card-hover:hover {
      transform: scale(1.02);
      transition: transform 0.3s ease;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }

  /* Border custom warna */
  .custom-border {
      border-top: 3px solid #3b82f6; /* Tailwind blue-500 */
  }
</style>

<x-slot name="header">
  <div class="flex items-center space-x-3">
      <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A4 4 0 007 20h10a4 4 0 001.879-7.596M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
      </svg>
      <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
          {{ __('Profil Pengguna') }}
      </h2>
  </div>
</x-slot>

<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen fade-in">
  <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl p-6 card-hover custom-border">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
              {{ __('Perbarui Informasi Profil') }}
          </h3>
          <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
              @include('profile.partials.update-profile-information-form')
          </div>
      </div>
  </div>
</div>

