<?php
namespace KasperKloster\MonkCommerce\Console\Commands;

use Illuminate\Console\Command;

use KasperKloster\MonkCommerce\Models\MonkCommerceUser;
use Illuminate\Support\Facades\Hash;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monkcommerce:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user with admin role';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $name = $this->ask('Type in admin username');
      $email = $this->ask('Type in email');
      $password = $this->secret('Type in password');

      if ($this->confirm('Will you insert. Name: ' . $name . 'email: ' . $email . ' as a admin?'))
      {
        $admin = MonkCommerceUser::create([
          'name'      => $name,
          'email'     => $email,
          'password'  => Hash::make($password),
          'role_id'   => '1',
        ]);

        return $this->info('Added: ' . $admin->name . ' as admin');
      }
      $this->warn('No admin was added');

    }
}
