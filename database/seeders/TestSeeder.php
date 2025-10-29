<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Brand;
use App\Models\Mobile;
use App\Models\MobileComment;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456'),
            'role'              => '1',
            'status'            => true,
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        // Create Manager
        User::create([
            'name'              => 'Manager',
            'email'             => 'manager@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456'),
            'role'              => '2',
            'status'            => true,
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        // Create User
        User::create([
            'name'              => 'User',
            'email'             => 'user@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456'),
            'role'              => '3',
            'status'            => true,
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        $faker = Faker::create();

        // Create Random Users
        for ($i = 0; $i < 30; $i++) {
            User::create([
                'name'              => $faker->name,
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password'          => Hash::make('123456'),
                'role'              => $faker->randomElement(['1', '2', '3']),
                'status'            => $faker->boolean,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }

        // Create Brands
        $users = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_MANAGER])->pluck('id')->toArray();

        $brands = [
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
            ['name' => 'Oppo', 'slug' => 'oppo'],
            ['name' => 'Vivo', 'slug' => 'vivo'],
            ['name' => 'OnePlus', 'slug' => 'oneplus'],
            ['name' => 'Realme', 'slug' => 'realme'],
            ['name' => 'Google', 'slug' => 'google'],
            ['name' => 'Huawei', 'slug' => 'huawei'],
            ['name' => 'Nothing', 'slug' => 'nothing'],
            ['name' => 'Sony', 'slug' => 'sony'],
            ['name' => 'Nokia', 'slug' => 'nokia'],
            ['name' => 'Motorola', 'slug' => 'motorola'],
            ['name' => 'Infinix', 'slug' => 'infinix'],
            ['name' => 'Tecno', 'slug' => 'tecno'],
            ['name' => 'Asus', 'slug' => 'asus'],
            ['name' => 'Honor', 'slug' => 'honor'],
            ['name' => 'ZTE', 'slug' => 'zte'],
            ['name' => 'Meizu', 'slug' => 'meizu'],
            ['name' => 'Lenovo', 'slug' => 'lenovo'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'user_id'    => $faker->randomElement($users),
                'name'       => $brand['name'],
                'slug'       => $brand['slug'],
                'status'     => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create Random Mobiles
        $users = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_MANAGER])->pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->word . ' ' . $faker->bothify('##??');

            Mobile::create([
                'user_id'               => $faker->randomElement($users),
                'brand_id'              => $faker->randomElement($brands),
                'name'                  => $name,
                'slug'                  => Str::slug($name),
                'versions'              => $faker->sentence(3),

                // Network
                'network_technology'    => $faker->randomElement(['GSM / CDMA / HSPA / LTE / 5G']),
                'network_2g_bands'      => $faker->word,
                'network_3g_bands'      => $faker->word,
                'network_4g_bands'      => $faker->word,
                'network_5g_bands'      => $faker->word,
                'network_speed'         => $faker->randomElement(['HSPA 42.2/5.76 Mbps', 'LTE-A', '5G']),

                // Body
                'body_dimensions'       => $faker->randomElement(['146.7 x 71.5 x 7.4 mm', '160 x 75 x 8 mm']),
                'body_weight'           => $faker->randomElement(['174 g', '190 g']),
                'body_build'            => $faker->word,
                'body_sim'              => $faker->word,

                // Display
                'display_type'          => $faker->randomElement(['Super AMOLED', 'LCD', 'OLED']),
                'display_size'          => $faker->randomElement(['6.1 inches', '6.5 inches']),
                'display_resolution'    => $faker->randomElement(['1080 x 2400 pixels', '1170 x 2532 pixels']),
                'display_protection'    => $faker->word,

                // Platform
                'platform_os'           => $faker->randomElement(['Android 13', 'iOS 17']),
                'platform_chipset'      => $faker->randomElement(['Snapdragon 8 Gen 3', 'Apple A17 Bionic']),
                'platform_cpu'          => $faker->word,
                'platform_gpu'          => $faker->word,

                // Memory
                'memory_card_slot'      => $faker->word,
                'memory_internal'       => $faker->randomElement(['64 GB', '128 GB', '256 GB']),

                // Main Camera
                'main_camera_setup'     => $faker->randomElement(['12 MP + 12 MP', '108 MP + 12 MP']),
                'main_camera_features'  => $faker->sentence(3),
                'main_camera_video'     => $faker->word,

                // Selfie Camera
                'selfie_camera_setup'   => $faker->randomElement(['8 MP', '12 MP']),
                'selfie_camera_features'=> $faker->sentence(2),
                'selfie_camera_video'   => $faker->word,

                // Sound
                'sound_loudspeaker'     => $faker->word,
                'sound_jack_3_5mm'      => $faker->randomElement(['Yes', 'No']),

                // Communications
                'comms_wlan'            => $faker->word,
                'comms_bluetooth'       => $faker->word,
                'comms_positioning'     => $faker->word,
                'comms_nfc'             => $faker->word,
                'comms_radio'           => $faker->word,
                'comms_usb'             => $faker->word,

                // Features
                'features_sensors'      => $faker->word,
                'features_extra'        => $faker->sentence(2),

                // Battery
                'battery_type'          => $faker->randomElement(['Li-Ion 4000 mAh', 'Li-Po 5000 mAh']),
                'battery_charging'      => $faker->randomElement(['Fast charging 33W', 'Wireless charging']),

                // Misc
                'misc_colors'           => $faker->randomElement(['Black, White', 'Blue, Red']),
                'misc_models'           => $faker->bothify('??###'),
                'misc_sar_us_head'      => $faker->randomFloat(2, 0.1, 2),
                'misc_sar_us_body'      => $faker->randomFloat(2, 0.1, 2),
                'misc_sar_eu_head'      => $faker->randomFloat(2, 0.1, 2),
                'misc_sar_eu_body'      => $faker->randomFloat(2, 0.1, 2),
                'misc_price'            => $faker->randomFloat(2, 100, 1500),

                'status'                => $faker->boolean,
                'views'                 => $faker->numberBetween(1000, 50000),
                'image'                 => null,
                'description'           => $faker->paragraph,

                // SEO
                'meta_title'            => $faker->sentence(3),
                'meta_keywords'         => $faker->words(5, true),
                'meta_description'      => $faker->sentence(10),
                'canonical_url'         => $faker->url,
                'og_title'              => $faker->sentence(3),
                'og_description'        => $faker->sentence(10),
                'og_image'              => null,

                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }

        // Create Mobile Comments
        $users = User::pluck('id')->toArray();
        $mobiles = Mobile::pluck('id')->toArray();

        foreach ($mobiles as $mobileId) {
            // Random number of comments per mobile
            $commentsCount = rand(1, 10);

            for ($i = 0; $i < $commentsCount; $i++) {
                MobileComment::create([
                    'mobile_id' => $mobileId,
                    'user_id'   => $faker->randomElement($users),
                    'comment'   => $faker->sentence(rand(5, 15)),
                    'stars'     => $faker->numberBetween(1, 5),
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }
    }
}
