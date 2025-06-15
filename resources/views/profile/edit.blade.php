<x-navbar>
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden px-4 py-8"
        style="background-image: url('{{ asset('images/bg-profile.jpg') }}'); background-size: cover; background-position: center;">
        <div
            class="relative z-10 w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl bg-white bg-opacity-20 backdrop-blur-lg rounded-3xl shadow-2xl p-4 sm:p-6 md:p-8 lg:p-10">

            <div class="flex justify-center mb-6">
                <div
                    class="bg-white bg-opacity-30 rounded-full p-4 shadow-lg transition-transform transform hover:scale-110">
                    <img src="{{ asset('assets/zoes.png') }}" alt="Logo Saya"
                        class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
                </div>
            </div>

            <h2 class="text-center text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-800 mb-6 sm:mb-8">Edit Profil
            </h2>

            {{-- FORM UTAMA EDIT PROFIL --}}
            {{-- Perhatian: Hapus ', $user->id)' dari action jika rute profile.update tidak mengharapkan ID --}}
            <form id="profileForm" method="POST" action="{{ route('profile.update') }}"
                enctype="multipart/form-data" class="space-y-4 sm:space-y-6">
                @csrf
                @method('patch') {{-- PENTING: Pastikan ini 'patch', BUKAN 'PUT' --}}

                <div>
                    <label for="name" class="block text-gray-700 mb-2 text-sm sm:text-base">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-2xl bg-white bg-opacity-30 placeholder-gray-600 text-gray-900 focus:outline-none focus:border-indigo-300 focus:bg-opacity-50 focus:shadow-md transition duration-200 border-2 border-white border-opacity-50">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-700 mb-2 text-sm sm:text-base">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        required
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-2xl bg-white bg-opacity-30 placeholder-gray-600 text-gray-900 focus:outline-none focus:border-indigo-300 focus:bg-opacity-50 focus:shadow-md transition duration-200 border-2 border-white border-opacity-50">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bagian Password --}}
                <div>
                    <label for="password" class="block text-gray-700 mb-2 text-sm sm:text-base">Password Baru
                        (Opsional)</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-2xl bg-white bg-opacity-30 placeholder-gray-600 text-gray-900 focus:outline-none focus:border-indigo-300 focus:bg-opacity-50 focus:shadow-md transition duration-200 border-2 border-white border-opacity-50">
                    <p class="text-gray-600 text-xs mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-700 mb-2 text-sm sm:text-base">Konfirmasi
                        Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-2xl bg-white bg-opacity-30 placeholder-gray-600 text-gray-900 focus:outline-none focus:border-indigo-300 focus:bg-opacity-50 focus:shadow-md transition duration-200 border-2 border-white border-opacity-50">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 sm:py-3 px-4 rounded-2xl transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                        Ubah Profil
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-navbar>