<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_information' => '{"name": "TRAVELER","contact": "+012 345 67890","email": "info@example.com","address": "123 Street, New York, USA","logo": "123 Street, New York, USA","common_banner": "123 Street, New York, USA"}',
            'company_socials' => '{"facebook": "aaa","twitter": "aaa","linkedIn": "aaa","instagram": "aaa"}',
            'company_banners' => '[{"id":1,"banner_title":"TOURS & TRAVEL","banner_text":"Lets Discover The World Together","banner_image":"john.doe@example.com"},{"id":2,"banner_title":"TOURS & TRAVEL","banner_text":"Discover Amazing Places With Us","banner_image":"jane.smith@example.com"}]',
            'company_about' => '{"title": "We Provide Best Tour Packages In Your Budget","body": "Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo","main_image": "https://example.com/main_image.jpg","body_images": ["https://example.com/body_image1.jpg","https://example.com/body_image2.jpg","https://example.com/body_image3.jpg"]}',
            'company_t&c' => '$2y$10$2VOzLDO6IhNJeQZC06OEce1hFfXNjCfDYCZOINDGKVAJeQr5AO5ju',
            'company_services' => '[{"id":1,"service_title":"Travel Guide","service_icon":"fa fa-2x fa-route","service_text":"Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est amet labore"},{"id":2,"service_title":"Ticket Booking","service_icon":"fa fa-2x fa-ticket-alt","service_text":"Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est amet labore"},{"id":3,"service_title":"Hotel Booking","service_icon":"fa fa-2x fa-hotel","service_text":"Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est amet labore"}]',
        ];
    }
}
