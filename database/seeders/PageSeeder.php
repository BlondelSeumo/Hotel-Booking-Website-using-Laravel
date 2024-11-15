<?php

namespace Database\Seeders;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Models\Page;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('backgrounds');
        $this->uploadFiles('services');
        $this->uploadFiles('brands');

        $pages = [
            [
                'name' => 'Home Page 01',
                'content' => '[simple-slider key="home-slider"][/simple-slider]' .
                    '[check-availability-form][/check-availability-form]' .
                    htmlentities('[about-us title="Most Safe & Rated Hotel In London." subtitle="About Us" description="At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you’re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.<br> <br>Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we’ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London." highlights="Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London’s charm.; Experience the perfect blend of luxury and comfort." style="style-1" button_label="DISCOVER MORE" button_url="/about-us" signature_image="general/signature.png" signature_author="Vincent Smith" top_left_image="services/about-img-02.png" bottom_right_image="services/about-img-03.png" floating_right_image="backgrounds/an-img-02.png"][/about-us]') .
                    '[featured-amenities title="The Hotel" subtitle="Explore" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_color="#F7F5F1" background_image="/backgrounds/an-img-01.png" amenity_ids="1,2,3,4,5,6"][/featured-amenities]' .
                    '[featured-rooms title="Rooms & Suites" subtitle="The Pleasure Of Luxury" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" room_ids="2,3,4,6,7"][/featured-rooms]' .
                    '[feature-area title="Pearl Of The Adriatic." subtitle="Luxury Hotel & Resort" description="Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." image="general/feature.png" background_image="backgrounds/an-img-02.png" button_primary_label="Discover More" button_primary_url="/contact-us" background_color="#F7F5F1"][/feature-area]' .
                    '[pricing title="Extra Services" subtitle="Best Prices" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." background_image_1="backgrounds/an-img-01.png" background_image_2="backgrounds/an-img-02.png" quantity="2" title_1="Room cleaning" description_1="Perfect for early-stage startups" price_1="$39.99" duration_1="Monthly" feature_list_1="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_1="Get Started" button_url_1="/contact-us" title_2="Drinks included" description_2="Perfect for early-stage startups" price_2="$59.99" duration_2="Monthly" feature_list_2="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_2="Get Started " button_url_2="/contact-us"][/pricing]' .
                    '[testimonials title="What Our Clients Says" subtitle="Testimonial" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="/backgrounds/testimonial-bg.png" testimonial_ids="1,2,3,5,6,4"][/testimonials]' .
                    '[booking-form title="Book A Room" subtitle="Make Reservation" image="general/booking-img.png" background_image="backgrounds/an-img-01.png" button_primary_label="Book Table Now" button_primary_url="/contact-us" style="style-2"][/booking-form]' .
                    '[intro-video title="Take A Tour Of Luxury" youtube_url="https://www.youtube.com/watch?v=ldusxyoq0Y8" background_image="general/video-bg.png"][/intro-video]' .
                    '[news title="Latest Blog & News" subtitle="Our Blog" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="backgrounds/an-img-07.png" type="featured" limit="3"][/news]' .
                    '[brands background_color="#F7F5F1" quantity="6" name_1="Ersintat" image_1="brands/logo-1.png" link_1="https://ersintat.com" name_2="Techradar" image_2="brands/logo-2.png" link_2="https://techradar.com" name_3="Turbologo" image_3="brands/logo-3.png" link_3="https://turbologo.com" name_4="Thepeer" image_4="brands/logo-4.png" link_4="https://thepeer.com" name_5="Techi" image_5="brands/logo-5.png" link_5="http://techi.com" name_6="Grapik" image_6="brands/logo-6.png" link_6="https://grapk.com"][/brands]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 0,
                ],
            ],
            [
                'name' => 'Home Page 02',
                'content' => '[hero-banner-with-booking-form title="Enjoy A Luxury Experience" description="Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus sed nisl tristique, commodo gravida lectus non." background_image="banners/slider-2.png" background_color="#101010" button_label="VISIT OUR SHOP" button_url="/rooms" form_title="Book A Room" form_button_label="Check Availability" form_button_url="/contact-us"][/hero-banner-with-booking-form]' .
                    htmlentities('[about-us title="Most Safe & Rated Hotel In London." subtitle="About Us" description="At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you’re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.<br> <br>Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we’ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London." highlights="Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London’s charm.; Experience the perfect blend of luxury and comfort." style="style-1" button_label="DISCOVER MORE" button_url="/about-us" signature_image="general/signature.png" signature_author="Vincent Smith" top_left_image="services/about-img-02.png" bottom_right_image="services/about-img-03.png" floating_right_image="backgrounds/an-img-02.png"][/about-us]') .
                    '[featured-amenities title="The Hotel" subtitle="Explore" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_color="#F7F5F1" background_image="/backgrounds/an-img-01.png" amenity_ids="1,2,3,4,5,6"][/featured-amenities]' .
                    '[featured-rooms title="Rooms & Suites" subtitle="The Pleasure Of Luxury" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" room_ids="2,3,4,6,7"][/featured-rooms]' .
                    '[feature-area title="Pearl Of The Adriatic." subtitle="Luxury Hotel & Resort" description="Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." image="general/feature.png" background_image="backgrounds/an-img-02.png" button_primary_label="Discover More" button_primary_url="/contact-us" background_color="#F7F5F1"][/feature-area]' .
                    '[pricing title="Extra Services" subtitle="Best Prices" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." background_image_1="backgrounds/an-img-01.png" background_image_2="backgrounds/an-img-02.png" quantity="2" title_1="Room cleaning" description_1="Perfect for early-stage startups" price_1="$39.99" duration_1="Monthly" feature_list_1="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_1="Get Started" button_url_1="/contact-us" title_2="Drinks included" description_2="Perfect for early-stage startups" price_2="$59.99" duration_2="Monthly" feature_list_2="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_2="Get Started " button_url_2="/contact-us"][/pricing]' .
                    '[testimonials title="What Our Clients Says" subtitle="Testimonial" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="/backgrounds/testimonial-bg.png" testimonial_ids="1,2,3,5,6,4"][/testimonials]' .
                    '[booking-form title="Book A Room" subtitle="Make Reservation" image="general/booking-img.png" background_image="backgrounds/an-img-01.png" button_primary_label="Book Table Now" button_primary_url="/contact-us" style="style-2"][/booking-form]' .
                    '[intro-video title="Take A Tour Of Luxury" youtube_url="https://www.youtube.com/watch?v=ldusxyoq0Y8" background_image="general/video-bg.png"][/intro-video]' .
                    '[news title="Latest Blog & News" subtitle="Our Blog" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="backgrounds/an-img-07.png" type="featured" limit="3"][/news]' .
                    '[brands background_color="#F7F5F1" quantity="6" name_1="Ersintat" image_1="brands/logo-1.png" link_1="https://ersintat.com" name_2="Techradar" image_2="brands/logo-2.png" link_2="https://techradar.com" name_3="Turbologo" image_3="brands/logo-3.png" link_3="https://turbologo.com" name_4="Thepeer" image_4="brands/logo-4.png" link_4="https://thepeer.com" name_5="Techi" image_5="brands/logo-5.png" link_5="http://techi.com" name_6="Grapik" image_6="brands/logo-6.png" link_6="https://grapk.com"][/brands]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 0,
                ],
            ],
            [
                'name' => 'Home Page Side Menu',
                'content' => '[simple-slider key="home-slider"][/simple-slider]' .
                    '[check-availability-form][/check-availability-form]' .
                    htmlentities('[about-us title="Most Safe & Rated Hotel In London." subtitle="About Us" description="At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you’re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.<br> <br>Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we’ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London." highlights="Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London’s charm.; Experience the perfect blend of luxury and comfort." style="style-1" button_label="DISCOVER MORE" button_url="/about-us" signature_image="general/signature.png" signature_author="Vincent Smith" top_left_image="services/about-img-02.png" bottom_right_image="services/about-img-03.png" floating_right_image="backgrounds/an-img-02.png"][/about-us]') .
                    '[featured-amenities title="The Hotel" subtitle="Explore" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_color="#F7F5F1" background_image="/backgrounds/an-img-01.png" amenity_ids="1,2,3,4,5,6"][/featured-amenities]' .
                    '[featured-rooms title="Rooms & Suites" subtitle="The Pleasure Of Luxury" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" room_ids="2,3,4,6,7"][/featured-rooms]' .
                    '[feature-area title="Pearl Of The Adriatic." subtitle="Luxury Hotel & Resort" description="Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." image="general/feature.png" background_image="backgrounds/an-img-02.png" button_primary_label="Discover More" button_primary_url="/contact-us" background_color="#F7F5F1"][/feature-area]' .
                    '[pricing title="Extra Services" subtitle="Best Prices" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." background_image_1="backgrounds/an-img-01.png" background_image_2="backgrounds/an-img-02.png" quantity="2" title_1="Room cleaning" description_1="Perfect for early-stage startups" price_1="$39.99" duration_1="Monthly" feature_list_1="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_1="Get Started" button_url_1="/contact-us" title_2="Drinks included" description_2="Perfect for early-stage startups" price_2="$59.99" duration_2="Monthly" feature_list_2="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_2="Get Started " button_url_2="/contact-us"][/pricing]' .
                    '[testimonials title="What Our Clients Says" subtitle="Testimonial" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="/backgrounds/testimonial-bg.png" testimonial_ids="1,2,3,5,6,4"][/testimonials]' .
                    '[booking-form title="Book A Room" subtitle="Make Reservation" image="general/booking-img.png" background_image="backgrounds/an-img-01.png" button_primary_label="Book Table Now" button_primary_url="/contact-us" style="style-2"][/booking-form]' .
                    '[intro-video title="Take A Tour Of Luxury" youtube_url="https://www.youtube.com/watch?v=ldusxyoq0Y8" background_image="general/video-bg.png"][/intro-video]' .
                    '[news title="Latest Blog & News" subtitle="Our Blog" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="backgrounds/an-img-07.png" type="featured" limit="3"][/news]' .
                    '[brands background_color="#F7F5F1" quantity="6" name_1="Ersintat" image_1="brands/logo-1.png" link_1="https://ersintat.com" name_2="Techradar" image_2="brands/logo-2.png" link_2="https://techradar.com" name_3="Turbologo" image_3="brands/logo-3.png" link_3="https://turbologo.com" name_4="Thepeer" image_4="brands/logo-4.png" link_4="https://thepeer.com" name_5="Techi" image_5="brands/logo-5.png" link_5="http://techi.com" name_6="Grapik" image_6="brands/logo-6.png" link_6="https://grapk.com"][/brands]',
                'template' => 'side-menu',
                'metadata' => [
                    'breadcrumb' => 0,
                ],
            ],
            [
                'name' => 'Home Page Full Menu',
                'content' => '[simple-slider key="home-slider"][/simple-slider]' .
                    '[check-availability-form][/check-availability-form]' .
                    '[featured-rooms title="Rooms & Suites" subtitle="The Pleasure Of Luxury" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" room_ids="2,3,4,6,7"][/featured-rooms]' .
                    '[feature-area title="Pearl Of The Adriatic." subtitle="Luxury Hotel & Resort" description="Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." image="general/feature.png" background_image="backgrounds/an-img-02.png" button_primary_label="Discover More" button_primary_url="/contact-us" background_color="#F7F5F1"][/feature-area]' .
                    htmlentities('[about-us title="Most Safe & Rated Hotel In London." subtitle="About Us" description="At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you’re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.<br> <br>Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we’ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London." highlights="Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London’s charm.; Experience the perfect blend of luxury and comfort." style="style-1" button_label="DISCOVER MORE" button_url="/about-us" signature_image="general/signature.png" signature_author="Vincent Smith" top_left_image="services/about-img-02.png" bottom_right_image="services/about-img-03.png" floating_right_image="backgrounds/an-img-02.png"][/about-us]') .
                    '[featured-amenities title="The Hotel" subtitle="Explore" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_color="#F7F5F1" background_image="/backgrounds/an-img-01.png" amenity_ids="1,2,3,4,5,6"][/featured-amenities]' .
                    '[pricing title="Extra Services" subtitle="Best Prices" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." background_image_1="backgrounds/an-img-01.png" background_image_2="backgrounds/an-img-02.png" quantity="2" title_1="Room cleaning" description_1="Perfect for early-stage startups" price_1="$39.99" duration_1="Monthly" feature_list_1="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_1="Get Started" button_url_1="/contact-us" title_2="Drinks included" description_2="Perfect for early-stage startups" price_2="$59.99" duration_2="Monthly" feature_list_2="Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis" button_label_2="Get Started " button_url_2="/contact-us"][/pricing]' .
                    '[testimonials title="What Our Clients Says" subtitle="Testimonial" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="/backgrounds/testimonial-bg.png" testimonial_ids="1,2,3,5,6,4"][/testimonials]' .
                    '[booking-form title="Book A Room" subtitle="Make Reservation" image="general/booking-img.png" background_image="backgrounds/an-img-01.png" button_primary_label="Book Table Now" button_primary_url="/contact-us" style="style-2"][/booking-form]' .
                    '[intro-video title="Take A Tour Of Luxury" youtube_url="https://www.youtube.com/watch?v=ldusxyoq0Y8" background_image="general/video-bg.png"][/intro-video]' .
                    '[news title="Latest Blog & News" subtitle="Our Blog" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="backgrounds/an-img-07.png" type="featured" limit="3"][/news]' .
                    '[brands background_color="#F7F5F1" quantity="6" name_1="Ersintat" image_1="brands/logo-1.png" link_1="https://ersintat.com" name_2="Techradar" image_2="brands/logo-2.png" link_2="https://techradar.com" name_3="Turbologo" image_3="brands/logo-3.png" link_3="https://turbologo.com" name_4="Thepeer" image_4="brands/logo-4.png" link_4="https://thepeer.com" name_5="Techi" image_5="brands/logo-5.png" link_5="http://techi.com" name_6="Grapik" image_6="brands/logo-6.png" link_6="https://grapk.com"][/brands]',
                'template' => 'full-menu',
                'metadata' => [
                    'breadcrumb' => 0,
                ],
            ],
            [
                'name' => 'About Us',
                'content' => htmlentities('[about-us title="Most Safe & Rated Hotel In London." subtitle="About Us" description="At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you’re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.<br> <br>Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we’ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London." highlights="Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London’s charm.; Experience the perfect blend of luxury and comfort." style="style-2" button_label="DISCOVER MORE" button_url="/about-us" signature_image="general/signature.png" signature_author="Vincent Smith" top_left_image="services/about-img-02.png" bottom_right_image="services/about-img-03.png" floating_right_image="backgrounds/an-img-02.png"][/about-us]') .
                    '[why-choose-us title="We Offer Wide Selection of Hotel" subtitle="Rio We Use" description="Explore a variety of handpicked hotels with Rio We Use. Your ideal stay is just a click away. Book now for an unforgettable experience." right_image="services/skills-img.png" background_color="#291D16" background_image="backgrounds/an-img-05.png" quantity="3" title_1="Quality Production" percentage_1="80" title_2="Maintenance Services" percentage_2="90" title_3="Product Management" percentage_3="70"][/why-choose-us]' .
                    htmlentities('[services title="Pearl Of The Adriatic." subtitle="Luxury Hotel & Resort" description="Indulge in the ultimate lavish escape at our Luxury Hotel & Resort, renowned as the Pearl of the Adriatic. Immerse yourself in unparalleled elegance and breathtaking coastal beauty for an unforgettable retreat. <br><br>Nestled along the stunning Adriatic coast, our Luxury Hotel & Resort stands as a beacon of opulence and tranquility. With panoramic views of the sparkling waters and world-class amenities at your fingertips, every moment becomes a precious gem. Experience unrivaled hospitality and immerse yourself in the allure of the Pearl of the Adriatic." left_image="services/feature.png" right_floating_image="backgrounds/an-img-02.png" button_label="DISCOVER MORE" button_url="/about-us"][/services]') .
                    '[news title="Latest Blog & News" subtitle="Our Blog" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="backgrounds/an-img-07.png" type="featured" limit="3"][/news]' .
                    '[newsletter title="Get Best Offers On The Hotel" subtitle="Newsletter" description="With the subscription, enjoy your favourite Hotels without having to think about it" background_color="#F7F5F1" left_floating_image="backgrounds/an-img-07.png"][/newsletter]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Services',
                'content' => '[service-list background_image="backgrounds/an-img-01.png" limit="6"][/service-list]' .
                    '[feature-area title="Pearl Of The Adriatic." subtitle="Luxury Hotel & Resort" description="Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget." image="general/feature.png" background_image="backgrounds/an-img-02.png" button_primary_label="Discover More" button_primary_url="/contact-us" background_color="#F7F5F1"][/feature-area]' .
                    '[booking-form title="Book A Room" subtitle="Make Reservation" image="general/booking-img.png" background_image="backgrounds/an-img-01.png" button_primary_label="Book Table Now" button_primary_url="/contact-us" style="style-2"][/booking-form]' .
                    '[testimonials title="What Our Clients Says" subtitle="Testimonial" description="Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel" background_image="/backgrounds/testimonial-bg.png" testimonial_ids="1,2,3,5,6,4"][/testimonials]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Galleries',
                'content' => '[galleries limit="10"][/galleries]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'FAQ',
                'content' => '[faqs category_ids="1,2,3,4,5"][/faqs]' .
                    '[newsletter title="Get Best Offers On The Hotel" subtitle="Newsletter" description="With the subscription, enjoy your favourite Hotels without having to think about it" background_color="#F7F5F1" left_floating_image="backgrounds/an-img-07.png"][/newsletter]' .
                    '[teams title="Best Expert Hotel" subtitle="Our Team" description="As a united team, we passionately craft your perfect stay, ensuring every detail reflects our commitment to exceptional hospitality." team_ids="1,2,3,4,5,6"][/teams]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Team',
                'content' => '[teams team_ids="1,2,3,4,5,6,7,8" style="style-2"][/teams]' .
                    '[why-choose-us title="We Offer Wide Selection of Hotel" subtitle="Rio We Use" description="Explore a variety of handpicked hotels with Rio We Use. Your ideal stay is just a click away. Book now for an unforgettable experience." right_image="services/skills-img.png" background_color="#291D16" background_image="backgrounds/an-img-05.png" quantity="3" title_1="Quality Production" percentage_1="80" title_2="Maintenance Services" percentage_2="90" title_3="Product Management" percentage_3="70"][/why-choose-us]' .
                    '[newsletter title="Get Best Offers On The Hotel" subtitle="Newsletter" description="With the subscription, enjoy your favourite Hotels without having to think about it" background_color="#F7F5F1" left_floating_image="backgrounds/an-img-07.png"][/newsletter]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Blog',
                'content' => '[blog-posts paginate="12"][/blog-posts]',
                'template' => 'blog-sidebar',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Contact Us',
                'content' => htmlentities('[contact-form title="Get In Touch" title_button="SUBMIT NOW" address_icon="far fa-map" address_label="Office Address" address_detail="380 St Kilda Road, Melbourne <br>VIC 3004, Australia" email_icon="far fa-envelope-open" email_label="Message Us" email_detail="support@example.com <br>info@example.com" work_time_icon="far fa-clock" work_time_label="Working Hours" work_time_detail="Monday to Friday 09:00 to 18:30 <br>Saturday 15:30" phone_icon="fa fa-phone" phone_label="(+1) 123 456 78" phone_detail=" 24/7 Customer Service And Returns Support."][/contact-form]') .
                    '[newsletter title="Get Best Offers On The Hotel" subtitle="Newsletter" description="With the subscription, enjoy your favourite Hotels without having to think about it" background_color="#F7F5F1" left_floating_image="backgrounds/an-img-07.png"][/newsletter]',
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Privacy',
                'content' => File::get(database_path('seeders/contents/privacy-content.html')),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
            [
                'name' => 'Term and Conditions',
                'content' => File::get(database_path('seeders/contents/term-conditions-content.html')),
                'template' => 'full-width',
                'metadata' => [
                    'breadcrumb' => 1,
                ],
            ],
        ];

        Page::query()->truncate();

        foreach ($pages as $item) {
            $item['user_id'] = 1;
            $page = Page::query()->create(Arr::except($item, ['metadata', 'slug']));

            if (array_key_exists('metadata', $item)) {
                foreach ($item['metadata'] as $key => $value) {
                    MetaBox::saveMetaBoxData($page, $key, $value);
                }
            }

            Slug::query()->create([
                'reference_type' => Page::class,
                'reference_id' => $page->id,
                'key' => Str::slug($item['slug'] ?? $page->name),
                'prefix' => SlugHelper::getPrefix(Page::class),
            ]);
        }
    }
}
