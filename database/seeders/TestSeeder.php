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
        $colors = ['black', 'white', 'silver', 'gray', 'gold', 'rose_gold', 'blue', 'navy', 'green', 'red', 'purple', 'orange', 'yellow', 'pink', 'bronze', 'titanium', 'graphite', 'other'];
        $osList = ['android', 'ios', 'kaios', 'windows phone', 'symbian', 'rim', 'bada', 'firefox', 'other'];
        $chipsets = ['Snapdragon', 'Apple A Series', 'Apple M Series', 'MediaTek Dimensity', 'MediaTek Helio', 'Exynos', 'Kirin', 'Google Tensor', 'Intel Atom', 'NVIDIA Tegra', 'Other'];
        $cores = ['Single-core', 'Dual-core', 'Triple-core', 'Quad-core', 'Hexa-core', 'Octa-core', 'Deca-core', 'Other'];

        for ($i = 0; $i < 30; $i++) {
            // Pick random user and brand from DB
            $userId = $faker->randomElement($users);
            $brandId = $faker->randomElement($brands);

            // Generate name based on brand (optional, more realistic)
            $brand = Brand::find($brandId);
            $name = $brand->name . ' ' . $faker->bothify('##??');

            Mobile::create([
                // Foreign Keys
                'user_id'               => $userId,
                'brand_id'              => $brandId,

                // Basic Info
                'name'                  => $name,
                'slug'                  => Str::slug($name),
                'status'                => $faker->boolean,
                'blog_color'            => $faker->hexColor(),
                'views'                 => $faker->numberBetween(1000, 100000),
                'image'                 => null,
                'description'           => $faker->paragraph,
                'versions'              => $faker->words(3, true),

                // Network
                'network_technology'    => 'GSM / HSPA / LTE / 5G',
                'network_2g_bands'      => 'GSM 850 / 900 / 1800 / 1900',
                'network_3g_bands'      => 'HSDPA 850 / 900 / 1900 / 2100',
                'network_4g_bands'      => 'LTE bands 1, 2, 3, 4, 5, 7',
                'network_5g_bands'      => '5G n1, n3, n41, n78',
                'network_speed'         => $faker->randomElement(['HSPA', 'LTE-A', '5G']),

                // Launch
                'launch_date'           => $faker->dateTimeBetween('-5 years', '-1 day')->format('Y-m-d'),
                'launch_status'         => $faker->randomElement(['Available', 'Coming soon', 'Discontinued']),

                // Body
                'body_dimensions'       => $faker->randomElement(['146 x 71 x 7 mm', '160 x 75 x 8 mm']),
                'body_weight'           => $faker->randomFloat(2, 150, 220),
                'body_build'            => $faker->randomElement(['Glass front', 'Plastic body', 'Aluminum frame']),
                'body_sim'              => $faker->randomElement(['Single SIM', 'Dual SIM']),
                'body_dual_sim'         => $faker->boolean,
                'body_e_sim'            => $faker->boolean,
                'body_sim_size'         => $faker->randomElement(['Mini-SIM', 'Micro-SIM', 'Nano-SIM']),

                // Display
                'display_type_detail'   => $faker->words(5, true),
                'display_type'          => $faker->randomElement(['Super AMOLED', 'OLED', 'LCD']),
                'display_size'          => $faker->randomFloat(2, 5.0, 7.0),
                'display_resolution_detail'   => $faker->words(5, true),
                'display_resolution'    => $faker->randomElement(['HD', 'HD+', 'Full HD', 'Full HD+', 'Quad HD', 'Quad HD+']),
                'display_refresh_rate'  => $faker->randomElement(['60Hz', '90Hz', '120Hz']),
                'display_protection'    => $faker->randomElement(['Gorilla Glass 5', 'Gorilla Glass Victus', null]),

                // Platform
                'platform_os'           => $faker->randomElement($osList),
                'platform_os_detail'    => $faker->words(5, true),
                'platform_chipset'      => $faker->randomElement($chipsets),
                'platform_chipset_detail'=> $faker->words(5, true),
                'platform_cpu'          => $faker->word,
                'platform_cpu_core'     => $faker->randomElement($cores),
                'platform_gpu'          => $faker->randomElement(['Adreno', 'Apple GPU', 'Mali', 'Other']),

                // Memory
                'memory_internal'       => $faker->randomElement(['32 GB', '64 GB', '128 GB', '256 GB']),
                'memory_internal_value' => $faker->randomElement([32, 64, 128, 256]),
                'memory_internal_unit'  => 'GB',
                'memory_ram_value'      => $faker->randomElement([2, 4, 6, 8, 12]),
                'memory_ram_unit'       => 'GB',
                'memory_card_slot'      => $faker->boolean,

                // Cameras
                'main_camera_name'      => $faker->word,
                'main_camera_pixel'     => $faker->numberBetween(12, 108),
                'main_camera_ultra_wide'=> $faker->boolean,
                'main_camera_flash'     => $faker->boolean,
                'main_camera_detail'    => $faker->sentence(5),
                'main_camera_features'  => $faker->sentence(5),
                'main_camera_video'     => $faker->sentence(5),

                'selfie_camera_name'    => $faker->word,
                'selfie_camera_pixel'   => $faker->numberBetween(5, 40),
                'selfie_camera_flash'   => $faker->boolean,
                'selfie_camera_detail'  => $faker->sentence(5),
                'selfie_camera_features'=> $faker->sentence(5),
                'selfie_camera_video'   => $faker->sentence(5),

                // Sound
                'sound_loudspeaker'     => $faker->boolean,
                'sound_loudspeaker_detail'=> $faker->sentence(2),
                'sound_dual_speaker'    => $faker->boolean,
                'sound_jack_3_5mm'      => $faker->boolean,

                // Communications
                'comms_wlan'            => $faker->randomElement(['wifi_80211_n', 'wifi_80211_ac', 'wifi_80211_ax']),
                'comms_bluetooth'       => $faker->randomElement(['bluetooth_4_2', 'bluetooth_5', 'bluetooth_5_2']),
                'comms_gps'             => $faker->boolean,
                'comms_nfc'             => $faker->boolean,
                'comms_radio'           => $faker->boolean,
                'comms_usb'             => $faker->randomElement(['usb_c', 'micro_usb', 'other']),

                // Features
                'features_sensors'      => $faker->randomElement(['accelerometer', 'gyroscope', 'fingerprint', 'face_id']),
                'features_sensors_details'=> $faker->sentence(5),
                'features_extra'        => $faker->sentence(5),

                // Battery
                'battery_detail'        => $faker->sentence(3),
                'battery_capacity'      => $faker->numberBetween(1500, 6000),
                'battery_wireless'      => $faker->boolean,
                'battery_removeable'    => $faker->boolean,
                'battery_fast_speed'    => $faker->boolean,
                'battery_charging_speed'=> $faker->randomElement([18, 25, 33, 45, 65]),

                // Misc
                'misc_colors'           => $faker->randomElement($colors),
                'misc_models'           => strtoupper($faker->bothify('??###')),
                'misc_sar_us_head'      => $faker->randomFloat(2, 0.1, 2),
                'misc_sar_us_body'      => $faker->randomFloat(2, 0.1, 2),
                'misc_sar_eu_head'      => $faker->randomFloat(2, 0.1, 2),
                'misc_sar_eu_body'      => $faker->randomFloat(2, 0.1, 2),
                'misc_price'            => $faker->randomFloat(2, 100, 2000),

                // SEO
                'seo_title'             => $faker->sentence(5),
                'seo_keywords'          => implode(', ', $faker->words(10)),
                'seo_description'       => $faker->sentence(10),

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
