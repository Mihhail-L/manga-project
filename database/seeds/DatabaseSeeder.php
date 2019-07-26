<?php

use App\Category;
use App\Tag;
use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(Category::class, 10)->create();
        factory(Tag::class, 10)->create();

        factory(User::class, 3)->create();
        $user = User::where('email', 'levin.mihhail@gmail.com')->first();
        if(!$user) {
            User::create([
                'role' => 'admin',
                'name' => 'Mihhail Levin',
                'username' => 'Miha',
                'email' => 'levin.mihhail@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
