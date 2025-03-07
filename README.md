LES ROUTER :


Route::middleware(['auth'])->group(function () {
    Route::get('/career-histories',CareerHistoryComponent ::class)->name('career-histories.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/RoleManager',RoleComponent ::class)->name('livewire.role-component');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/PermissionManager',PermissionComponent ::class)->name('livewire.permission-component');
});
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
    Route::get('/CareerManagement',CareerManagement ::class)->name('livewire.career-management');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
      Route::get('/departments', Departments::class)->name('departments');});
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
      Route::get('/contracts', ContractComponent::class)->name('contracts');});
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
   Route::get('/formation', FormationComponent::class)->name('trainings');});

Route::middleware(['auth', CheckRole::class.':employee'])->group(function () {
   Route::get('/addConge', CongeForm::class)->name('livewire.conge-form');});
   Route::middleware(['auth', CheckRole::class.':RH'])->group(function () {
Route::get('/ListConge', LeaveRequestList::class)->name('livewire.leave-request-list');});
Route::get('/ListEmployee', EmployeesList::class)->name('livewire.employees-list');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/user',UserComponent::class)->name('user');

et seeder 
ContractTypeSeeder:
 DB::table('contract_types')->insert([
                [
                    'name' => 'CDI',
                    'description' => 'Contrat à Durée Indéterminée',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'CDD',
                    'description' => 'Contrat à Durée Déterminée',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Stage',
                    'description' => 'Convention de stage',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Freelance',
                    'description' => 'Mission en freelance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Alternance',
                    'description' => 'Contrat en alternance',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Intérim',
                    'description' => 'Contrat de mission temporaire',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

  RolesAndPermissionsSeeder: $admin = Role::create(['name' => 'admin']);
        $manager=Role::create(['name'=>'manager']);
        $RH=Role::create(['name'=>'RH']);
        $employe=Role::create(['name'=>'employe']);

        $permissions=[
            'view employees',
            'edit employees',
            'delete employees',
            'manage payroll',
            'approve leaves',
            'generate reports'
        ];
    RoleSeeder: public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
         $permission_manage_users = Permission::create(['name' => 'manage users']);
          $role_admin->givePermissionTo($permission_manage_users);
          $user=User::find(1);
          $user->assignRole($role_admin);



    }

    UserSeeder:for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Employee ' . $i,
                'email' => 'employee' . $i . '@example.com',
                'password' => Hash::make('password123'), // Mot de passe hashé
                'role' => 'employee',
                'employee_id' => 'EMP00' . $i,
                'position' => 'Developer',
                'department' => 'IT',
                'hire_date' => now()->subDays(rand(30, 365)), // Date aléatoire
                'status' => 'active',
                'phone' => '06000000' . $i,
                'address' => '123 Employee Street ' . $i,
                'date_of_birth' => now()->subYears(rand(20, 40))->format('Y-m-d'),
                'gender' => rand(0, 1) ? 'male' : 'female',
                'contract_type' => rand(0, 1) ? 'permanent' : 'contract',
                'profile_picture' => 'profile_pictures/default.png',

            //////    (ona modifie les user done database )    

  deja un probleme sur add user donc ona les compte qui auth :
 dojaoualla@gmail.com (12345678)Admin;
  fati@gmail.com(12345678)  employee | RH                        