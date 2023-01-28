<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;


class itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //
        for ($i = 0; $i < 50; $i++){
            
            DB::table('listedItems')->insert([
                'itemPic'=>'https://picsum.photos/1024/1024?nocache='.microtime(),
                'itemName'=>Str::random(12),
                'itemType'=>Str::random(10),
                'itemPrice'=>rand(2,100),
                'description'=>Str::random(20)
    
            ]);
        }
        
    }

    
}
