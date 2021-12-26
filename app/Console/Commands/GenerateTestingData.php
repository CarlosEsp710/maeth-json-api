<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class GenerateTestingData extends Command
{
    use ConfirmableTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:test-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test data for the API.';

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
     * @return int
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return 1;
        }

        User::query()->delete();
        Article::query()->delete();
        Category::query()->delete();
        Patient::query()->delete();

        $admin = User::factory()->hasArticles(1)->create([
            'first_name' => 'User ADMIN',
            'last_name' => 'UNICLA',
            'email' => '20219219M@UNICLA.EDU.MX',
            'verified' => User::ACCEPTED,
            'type' => User::ADMIN,
        ]);

        $patient = User::factory()->hasArticles(1)->create([
            'first_name' => 'User Patient',
            'last_name' => 'UNICLA',
            'email' => '20219220M@UNICLA.EDU.MX',
            'verified' => User::ACCEPTED,
            'type' => User::PATIENT,
        ]);

        $nutritionist = User::factory()->hasArticles(1)->create([
            'first_name' => 'User Nutritionist',
            'last_name' => 'UNICLA',
            'email' => '20219221M@UNICLA.EDU.MX',
            'verified' => User::ACCEPTED,
            'type' => User::NUTRITIONIST,
        ]);

        $admin->assignRole('admin');
        $patient->assignRole('admin');
        $nutritionist->assignRole('admin');

        $this->info('Admin UUID:');
        $this->line($admin->id);

        $this->info('Token:');
        $this->line($admin->createToken('UNICLA_ADMIN')->plainTextToken);

        $this->info('Nutritionist UUID:');
        $this->line($nutritionist->id);

        $this->info('Token:');
        $this->line($nutritionist->createToken('UNICLA_NUTRITIONIST')->plainTextToken);

        $this->info('Patient UUID:');
        $this->line($patient->id);

        $this->info('Token:');
        $this->line($patient->createToken('UNICLA_PATIENT')->plainTextToken);

        // $articles = Article::factory(14)->create();

        // $this->info('Article ID:');
        // $this->line($user->articles->first()->slug);

        // $this->info('Category ID:');
        // $this->line($articles->first()->category->slug);
    }
}
