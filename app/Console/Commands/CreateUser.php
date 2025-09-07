<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create
                            {--name= : The name of the user}
                            {--admin : Make the user an admin}
                            {--team= : The team ID to assign the user to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user account';

    /**
     * Words to use in generated passwords
     *
     * @var array<string>
     */
    protected $words = [
        'apple', 'banana', 'cherry', 'date', 'fig', 'grape', 'kiwi', 'lemon', 'mango', 'boat',
        'car', 'plane', 'train', 'bike', 'bus', 'cat', 'dog', 'fish', 'bird', 'lion', 'tiger',
        'red', 'blue', 'green', 'yellow', 'purple', 'orange', 'black', 'white', 'gray', 'pink',
        'quick', 'lazy', 'happy', 'sad', 'bright', 'dark', 'fast', 'slow', 'strong', 'weak',
        'jump', 'run', 'swim', 'fly', 'climb', 'dance', 'sing', 'read', 'write', 'draw',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: $this->ask('What is the user\'s name?');
        $email = strtolower(preg_replace('/\s+/', '.', trim($name))) . '@changeme.com';
        $password = strtoupper($this->words[array_rand($this->words)]) . strtoupper($this->words[array_rand($this->words)]) . random_int(0, 99);
        $isAdmin = $this->option('admin') ?: $this->confirm('Should this user be an admin?', false);
        
        // Validate input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('Invalid input:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('  ' . $error);
            }
            return Command::FAILURE;
        }

        // Create the user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => $isAdmin,
            'email_verified_at' => now(),
        ]);

        // Handle team assignment
        $teamId = $this->option('team');
        if ($teamId) {
            $team = Team::find($teamId);
            if ($team) {
                $user->teams()->attach($team);
                $this->info("User assigned to team: {$team->name}");
            } else {
                $this->warn("Team with ID {$teamId} not found. User created without team assignment.");
            }
        } elseif (!$isAdmin) {
            // Show available teams and ask for selection
            $teams = Team::all();
            if ($teams->isNotEmpty()) {
                $this->info('Available teams:');
                foreach ($teams as $team) {
                    $this->line("  [{$team->id}] {$team->name}");
                }
                
                $selectedTeamId = $this->ask('Enter team ID to assign user to (optional)');
                if ($selectedTeamId && is_numeric($selectedTeamId)) {
                    $team = Team::find($selectedTeamId);
                    if ($team) {
                        $user->teams()->attach($team);
                        $this->info("User assigned to team: {$team->name}");
                    } else {
                        $this->warn("Team with ID {$selectedTeamId} not found.");
                    }
                }
            }
        }

        $this->info("User created successfully!");
        $this->table(
            ['Name', 'Email', 'Admin', 'Created'],
            [[$user->name, $user->email, $user->is_admin ? 'Yes' : 'No', $user->created_at->format('Y-m-d H:i:s')]]
        );

        $this->warn("Temporary Email: {$email}");
        $this->warn("Temporary password: {$password}");

        return Command::SUCCESS;
    }
}
