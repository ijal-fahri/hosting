
<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 dark:text-white">Edit Profil</h1>

    <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <!-- Nama -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <!-- Tombol Simpan -->
        <div class="text-center">
            <button id="saveButton" type="submit" class="bg-blue-400 text-white px-6 py-3 rounded-lg transition opacity-50 cursor-not-allowed" disabled>
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>



<!-- Script Preview Gambar + Enable Tombol -->
<script>
function previewProfile(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('profile_preview');
        preview.src = e.target.result;
    };
    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

const form = document.getElementById('profileForm');
const saveButton = document.getElementById('saveButton');
const originalData = new FormData(form);

form.addEventListener('input', () => {
    const currentData = new FormData(form);
    let changed = false;

    for (let key of originalData.keys()) {
        if (originalData.get(key) !== currentData.get(key)) {
            changed = true;
            break;
        }
    }

    if (changed) {
        saveButton.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-blue-400');
        saveButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
        saveButton.disabled = false;
    } else {
        saveButton.classList.add('opacity-50', 'cursor-not-allowed', 'bg-blue-400');
        saveButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        saveButton.disabled = true;
    }
});
</script>

