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
use App\Models\News;
use App\Models\NewsComment;
use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\Video;

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

        // Create Users
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
                'status'     => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create Mobiles
        $users = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_MANAGER])->pluck('id')->toArray();
        $brands = Brand::where('status', 1)->pluck('id')->toArray();
        $colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FFA500', '#800080', '#00FFFF', '#FFC0CB', '#A52A2A', '#808080'];

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->word . ' ' . $faker->bothify('##??');

            Mobile::create([
                'user_id'               => $faker->randomElement($users),
                'brand_id'              => $faker->randomElement($brands),
                'name'                  => $name,
                'slug'                  => Str::slug($name),

                // Versions
                'versions'   => $faker->sentence(3),

                // Network
                'network_technology'    => $faker->randomElement(['GSM / CDMA / HSPA / LTE / 5G']),
                'network_2g_bands'      => $faker->word,
                'network_3g_bands'      => $faker->word,
                'network_4g_bands'      => $faker->word,
                'network_5g_bands'      => $faker->word,
                'network_speed'         => $faker->randomElement(['HSPA 42.2/5.76 Mbps', 'LTE-A', '5G']),

                // Launch
                'launch_date' => $faker->date('Y-m-d', 'now'),
                'launch_status' => $faker->randomElement(['Available', 'Coming soon', 'Discontinued']),

                // Body
                'body_dimensions'       => $faker->randomElement(['146.7 x 71.5 x 7.4 mm', '160 x 75 x 8 mm']),
                'body_weight'           => $faker->randomElement(['174 g', '190 g']),
                'body_build'            => $faker->word,
                'body_sim'              => $faker->randomElement(['Single SIM', 'Dual SIM']),

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

                // SEO
                'seo_title'        => $faker->sentence(3),
                'seo_keywords'     => implode(', ', $faker->words(5)),
                'seo_description'  => $faker->sentence(10),

                // General
                'status'                => $faker->boolean,
                'color'                 => $faker->randomElement($colors),
                'views'                 => $faker->numberBetween(10000, 99999),
                'description'           => $faker->paragraph,

                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }

        // Create Mobile Comments
        $users = User::where('status', 1)->pluck('id')->toArray();
        $mobiles = Mobile::where('status', 1)->pluck('id')->toArray();

        foreach ($mobiles as $mobileId) {
            // Random number of comments per mobile
            $commentsCount = rand(1, 10);

            for ($i = 0; $i < $commentsCount; $i++) {
                MobileComment::create([
                    'mobile_id' => $mobileId,
                    'user_id'   => $faker->randomElement($users),
                    'comment'   => $faker->sentence(rand(5, 15)),
                    'stars'     => $faker->numberBetween(1, 5),
                    'status'     => $faker->boolean,
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }

        // Create News
        $users = User::where('status', 1)->pluck('id')->toArray();
        $mobiles = Mobile::where('status', 1)->pluck('id')->toArray();

        foreach ($mobiles as $mobileId) {
            $title = $faker->unique()->sentence(rand(3, 7));

            News::create([
                'user_id'       => $faker->randomElement($users),
                'mobile_id'     => $mobileId,
                'title'         => $title,
                'slug'          => Str::slug($title),
                'status'        => $faker->randomElement(['draft', 'published', 'archived']),
                'body'          => $faker->paragraphs(rand(3, 7), true),
                'views'         => $faker->numberBetween(0, 5000),
                'seo_title'     => $faker->sentence(5),
                'seo_keywords'  => implode(', ', $faker->words(5)),
                'seo_description' => $faker->sentence(10),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        // Create News Comments
        $users = User::where('status', 1)->pluck('id')->toArray();
        $newsList = News::where('status', 'published')->pluck('id')->toArray();

        foreach ($newsList as $newsId) {
            $commentsCount = rand(1, 10);

            for ($i = 0; $i < $commentsCount; $i++) {
                NewsComment::create([
                    'news_id'   => $newsId,
                    'user_id'   => $faker->randomElement($users),
                    'comment'   => $faker->sentence(rand(5, 15)),
                    'stars'     => $faker->numberBetween(1, 5),
                    'status'    => $faker->boolean,
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }

        // Create Reviews
        $users = User::where('status', 1)->pluck('id')->toArray();
        $mobiles = Mobile::where('status', 1)->pluck('id')->toArray();

        foreach ($mobiles as $mobileId) {
            $title = $faker->unique()->sentence(rand(3, 7));

            Review::create([
                'mobile_id'       => $mobileId,
                'user_id'         => $faker->randomElement($users),
                'title'           => $title,
                'slug'            => Str::slug($title),
                'image'           => null,
                'status'          => $faker->randomElement(['draft', 'published', 'archived']),
                'body'            => $faker->paragraphs(rand(3, 7), true),
                'views'           => $faker->numberBetween(0, 5000),
                'seo_title'       => $faker->sentence(5),
                'seo_keywords'    => implode(', ', $faker->words(5)),
                'seo_description' => $faker->sentence(10),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }

        // Create Review Comments
        $users = User::where('status', 1)->pluck('id')->toArray();
        $reviews = Review::where('status', 'published')->pluck('id')->toArray();

        foreach ($reviews as $reviewId) {
            $commentsCount = rand(1, 10);

            for ($i = 0; $i < $commentsCount; $i++) {
                ReviewComment::create([
                    'review_id' => $reviewId,
                    'user_id'   => $faker->randomElement($users),
                    'comment'   => $faker->sentence(rand(5, 15)),
                    'stars'     => $faker->numberBetween(1, 5),
                    'status'    => $faker->boolean(),
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }

        // Create Videos
        $users = User::where('status', 1)->pluck('id')->toArray();
        $mobiles = Mobile::where('status', 1)->pluck('id')->toArray();

        $videoLinks = [
            'https://www.youtube.com/watch?v=V8xq7tQ5o0o', // iPhone 15 Pro Review - MKBHD
            'https://www.youtube.com/watch?v=H0TfxIVzC0o', // Samsung Galaxy S24 Ultra Review - Mrwhosetheboss
            'https://www.youtube.com/watch?v=9l1wVQ0T8uI', // Google Pixel 8 Review - The Verge
            'https://www.youtube.com/watch?v=Q0hSgX0nG3A', // OnePlus 12 Review - TechDroider
            'https://www.youtube.com/watch?v=G8wC8Zj8Z9A', // Xiaomi 14 Pro Hands-On - GSMArena
            'https://www.youtube.com/watch?v=VbOjRKE1jCQ', // Nothing Phone 2 Review - Marques Brownlee
            'https://www.youtube.com/watch?v=I1zqz7xkE2A', // Vivo X100 Pro Review - Tech Spurt
            'https://www.youtube.com/watch?v=h1rY1E5wC_c', // Oppo Find X7 Pro Review - Android Authority
            'https://www.youtube.com/watch?v=2oWnT5sMQcA', // Realme GT 5 Review - Dave Lee
            'https://www.youtube.com/watch?v=5K7m7Y0jPjE', // Asus ROG Phone 8 Review - GSMArena
            'https://www.youtube.com/watch?v=6Y7K8Z1dMj4', // Honor Magic 6 Pro Hands-On
            'https://www.youtube.com/watch?v=fJ3Vh2fWyoE', // Huawei Mate 60 Pro Review
            'https://www.youtube.com/watch?v=Em9dFJ6rCjs', // Sony Xperia 1 V Review
            'https://www.youtube.com/watch?v=U3RcT3xF1Zs', // Nokia X30 Review
            'https://www.youtube.com/watch?v=FJmYv6Y0V8U', // Infinix Zero 30 Review
            'https://www.youtube.com/watch?v=T4JtKhV4u8M', // Tecno Phantom V Flip Review
            'https://www.youtube.com/watch?v=gfLkZnHfT-U', // Motorola Edge 50 Ultra Review
            'https://www.youtube.com/watch?v=yF9v9d8ZpRE', // Lenovo Legion Phone Duel Review
            'https://www.youtube.com/watch?v=mvE6bULaRdo', // ZTE Nubia RedMagic 9 Pro Review
            'https://www.youtube.com/watch?v=dM9iCz2o0Bc', // Meizu 20 Infinity Review
        ];

        foreach ($mobiles as $index => $mobileId) {
            $link = $videoLinks[$index % count($videoLinks)];

            Video::create([
                'user_id'   => $faker->randomElement($users),
                'mobile_id' => $mobileId,
                'link'      => $link,
                'status'    => $faker->boolean(80),
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }
    }
}
