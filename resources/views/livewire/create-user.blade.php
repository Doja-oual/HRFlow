<div class="max-w-md mx-auto p-6 bg-gradient-to-br from-blue-50 to-purple-50 border border-gray-200 rounded-lg shadow-lg">


    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-200 pb-3">Créer un Nouvel Utilisateur</h2>

    <form wire:submit.prevent="createUser" class="space-y-6">
        <!-- Section Informations Personnelles -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informations Personnelles</h3>

            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600 mb-2">Nom</label>
                <input type="text" id="name" wire:model="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                <input type="email" id="email" wire:model="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Mot de passe</label>
                <input type="password" id="password" wire:model="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-600 mb-2">Date de naissance</label>
                <div class="flex space-x-2">
                    <input type="number" id="day" wire:model="day" placeholder="JJ" class="w-1/3 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <input type="number" id="month" wire:model="month" placeholder="MM" class="w-1/3 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <input type="number" id="year" wire:model="year" placeholder="AAAA" class="w-1/3 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                </div>
                @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-600 mb-2">Genre</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" id="male" wire:model="gender" value="male" class="mr-2 focus:ring-purple-500" required>
                        <span class="text-sm text-gray-700">Homme</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" id="female" wire:model="gender" value="female" class="mr-2 focus:ring-purple-500" required>
                        <span class="text-sm text-gray-700">Femme</span>
                    </label>
                </div>
                @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Section Informations Professionnelles -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informations Professionnelles</h3>

            <!-- Rôle -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-600 mb-2">Rôle</label>
                <select id="role" wire:model="role" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <option value="">Sélectionner un rôle</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="employee">Employé</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            

            <!-- Poste -->
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-600 mb-2">Poste</label>
                <input type="text" id="position" wire:model="position" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Département -->
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium text-gray-600 mb-2">Département</label>
                <input type="text" id="department" wire:model="department" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('department') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date d'embauche -->
            <div class="mb-4">
                <label for="hire_date" class="block text-sm font-medium text-gray-600 mb-2">Date d'embauche</label>
                <input type="date" id="hire_date" wire:model="hire_date" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('hire_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600 mb-2">Statut</label>
                <select id="status" wire:model="status" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <option value="">Sélectionner un statut</option>
                    <option value="active">Actif</option>
                    <option value="inactive">Inactif</option>
                    <option value="on_leave">En congé</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Section Contact -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Contact</h3>

            <!-- Téléphone -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-600 mb-2">Téléphone</label>
                <input type="tel" id="phone" wire:model="phone" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-600 mb-2">Adresse</label>
                <textarea id="address" wire:model="address" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" rows="3" required></textarea>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Section Autres -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Autres Informations</h3>

            <!-- Type de contrat -->
            <div class="mb-4">
                <label for="contract_type" class="block text-sm font-medium text-gray-600 mb-2">Type de contrat</label>
                <select id="contract_type" wire:model="contract_type" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    <option value="">Sélectionner un type</option>
                    <option value="permanent">Permanent</option>
                    <option value="temporary">Temporaire</option>
                    <option value="freelance">Freelance</option>
                </select>
                @error('contract_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Photo de profil -->
            <div class="mb-4">
                <label for="profile_picture" class="block text-sm font-medium text-gray-600 mb-2">Photo de profil</label>
                <input type="file" id="profile_picture" wire:model="profile_picture" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                @error('profile_picture') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="mt-8 flex justify-center">
    <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-300">
        Créer Utilisateur
    </button>
</div>

</div>
    </form>
</div>