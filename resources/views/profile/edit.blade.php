<!-- resources/views/profile/edit.blade.php -->
<x-navbar>
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden px-4 py-8" 
         style="background-image: url('{{ asset('images/bg-profile.jpg') }}'); background-size: cover; background-position: center;">
      <div class="relative z-10 w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl bg-white bg-opacity-20 backdrop-blur-lg rounded-3xl shadow-2xl p-4 sm:p-6 md:p-8 lg:p-10">
  
        <!-- Logo -->
        <div class="flex justify-center mb-6">
          <div class="bg-white bg-opacity-30 rounded-full p-4 shadow-lg transition-transform transform hover:scale-110">
            <img src="{{ asset('assets/zoes.png') }}" alt="Logo Saya" class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
          </div>
        </div>
  
        <!-- Judul -->
        <h2 class="text-center text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-800 mb-6 sm:mb-8">Edit Profil</h2>
  
        <!-- Form -->
        <form id="profileForm"
              method="POST"
              action="{{ route('profile.update', $user->id) }}"
              enctype="multipart/form-data"
              class="space-y-4 sm:space-y-6">
          @csrf
          @method('PUT')
  
          <!-- Nama Lengkap -->
          <div>
            <label for="name" class="block text-gray-700 mb-2 text-sm sm:text-base">Nama Lengkap</label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ old('name', $user->name) }}"
                   required
                   class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-2xl bg-white bg-opacity-30 placeholder-gray-600 text-gray-900 focus:outline-none focus:border-indigo-300 focus:bg-opacity-50 focus:shadow-md transition duration-200 border-2 border-white border-opacity-50">
          </div>
  
          <!-- Email -->
          <div>
            <label for="email" class="block text-gray-700 mb-2 text-sm sm:text-base">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   value="{{ old('email', $user->email) }}"
                   required
                   class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-2xl bg-white bg-opacity-30 placeholder-gray-600 text-gray-900 focus:outline-none focus:border-indigo-300 focus:bg-opacity-50 focus:shadow-md transition duration-200 border-2 border-white border-opacity-50">
          </div>
  
        
        </form>
  
      </div>
    </div>
  </x-navbar>
  
  
  