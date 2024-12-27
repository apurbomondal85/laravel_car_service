@php
$heroServices = [
["title" => "New Build", "details" => "At Bangla Construction Limited., our New Build service encompasses the creation of stunning, custom-built structures from the ground up. From conceptualization to completion, we handle every aspect of the construction process with precision and expertise. Our team works closely with clients to bring their visions to life, ensuring superior quality and attention to detail in every new build project we undertake.", "image" =>
'frontend/image/services/New-Build.webp',],
["title" => "Foundations", "details" => "Bangla Construction Limited. offers comprehensive foundation services, laying the groundwork for sturdy and enduring structures. Our expert team ensures meticulous planning and execution, utilising industry-leading techniques and materials to create strong foundations that withstand the test of time. Whether it's for residential or commercial projects, our foundation services provide the stability and reliability necessary for building success. Trust us to lay the groundwork for your dreams.", "image" => 'frontend/image/services/Foundations.webp'],
["title" => "Footing", "details" => "As a premier construction and renovation company, Bangla Construction Limited. specialises in expert footing services. Our team meticulously prepares and install footings with precision, ensuring the structural integrity of every project. Whether for new construction or renovation, our footing services provide the essential groundwork for safe and stable structures. Trust us to lay the foundation for your vision with skill and expertise.", "image" =>
'frontend/image/services/Footing.webp'],
["title" => "Earthmoving", "details" => "At Bangla Construction Limited, our earthmoving service is essential for preparing sites and shaping landscapes with precision. Using advanced equipment and skilled operators, we handle earthmoving tasks efficiently and safely. From site clearing to excavation, our earthmoving services are integral to construction and renovation projects, ensuring the groundwork is laid for successful outcomes. Trust us for reliable earthmoving solutions tailored to your needs.", "image" =>
'frontend/image/services/Earthmoving.webp'],
["title" => "Demolition", "details" => "Bangla Construction Limited. offers professional demolition services tailored to meet the needs of your construction or renovation project. With safety and efficiency as our top priorities, our skilled team utilises advanced equipment and techniques to dismantle structures safely and effectively. Whether it's a small-scale demolition or a larger project, trust us to handle the job with precision and care, leaving your site ready for the next phase.", "image" =>
'frontend/image/services/Demolition.webp'],
["title" => "Renovation", "details" => "Bangla Construction Limited. specialises in transformative renovation services that breathe new life into existing spaces. With meticulous attention to detail and craftsmanship, our expert team revitalises interiors and exteriors, enhancing functionality, aesthetics, and value. Whether it's a residential or commercial property, our renovation services are tailored to meet your unique needs and exceed your expectations, turning your vision into reality with precision and care.", "image" =>
'frontend/image/services/Renovation.webp'],
["title" => "Maintenance", "details" => "Bangla Construction Limited. offers expert maintenance services to keep your properties in top condition. From routine inspections to repairs and upgrades, our skilled team ensures the longevity and functionality of your buildings. Whether it's residential or commercial, we provide proactive maintenance solutions tailored to your needs, ensuring that your property remains safe, secure, and efficient for years to come. Trust us for reliable maintenance services that protect your investment", "image" =>
'frontend/image/services/Maintenance.webp'],
["title" => "Retaining wall", "details" => "Bangla Construction Limited. specialises in building durable and aesthetically pleasing retaining walls to support and enhance your landscape. Our expert team designs and constructs retaining walls that effectively prevent soil erosion, create level terraces, and add visual appeal to your property. Whether for residential or commercial projects, trust us to deliver reliable and attractive retaining wall solutions tailored to your needs", "image" =>
'frontend/image/services/Retaining-Wall.webp'],
["title" => "Drive Way", "details" => "Bangla Construction Limited. offers professional driveway construction services to enhance the curb appeal and functionality of your property. Our skilled team designs and instals driveways using high-quality materials and precision techniques, ensuring durability and longevity. Whether it's a residential driveway or a commercial parking lot, trust us to deliver a smooth, well-constructed surface that adds value and convenience to your property.", "image" =>
'frontend/image/services/DriveWay.webp'],
["title" => "Landscaping", "details" => "Bangla Construction Limited. provides comprehensive landscaping services to transform outdoor spaces into stunning and functional environments. Our expert team collaborates closely with clients to design custom landscapes that suit their aesthetic preferences and lifestyle needs. From garden design to hardscaping and planting, we ensure every aspect of your landscape is meticulously planned and executed to enhance the beauty and value of your property. Trust us for professional landscaping solutions that exceed expectations.", "image" =>
'frontend/image/services/Landscaping.webp'],
["title" => "Fencing", "details" => "Bangla Construction Limited. specialises in professional fencing services to enhance the security and aesthetics of your property. Our skilled team designs and initials a variety of fencing options, including wood, metal, and vinyl, tailored to your specific needs and preferences. Whether it's for residential or commercial purposes, trust us to deliver durable, stylish, and functional fencing solutions that add value and curb appeal to your property.", "image" =>
'frontend/image/services/Fencing.webp'],
["title" => "Decking", "details" => "Bangla Construction Limited. offers expert decking services to enhance your outdoor living space with stylish and functional decks. Our skilled team designs and constructs custom decks using high-quality materials and craftsmanship. Whether it's a small patio or a large entertainment area, we ensure that your deck complements your property's aesthetics and meets your lifestyle needs. Trust us to create a beautiful and durable outdoor retreat for relaxation and entertainment.", "image" =>
'frontend/image/services/Decking.webp'],
["title" => "Painting", "details" => "Bangla Construction Limited. provides professional painting services to refresh and revitalise your interior and exterior spaces. Our skilled painters use high-quality paints and precision techniques to deliver flawless finishes that enhance the beauty and durability of your surfaces. Whether it's walls, ceilings, or trim, trust us to transform your space with expert painting solutions tailored to your preferences and budget.", "image" =>
'frontend/image/services/Painting.webp'],
["title" => "Flooring", "details" => "Bangla Construction Limited. offers premium flooring services to elevate the aesthetics and functionality of your space. Our expert team provides a wide range of flooring options, including SPC and timber flooring, tailored to your preferences and needs. Whether it's for residential or commercial properties, we ensure precise installation and superior craftsmanship to deliver durable and beautiful flooring solutions that enhance your space's appeal and value.", "image" =>
'frontend/image/services/Flooring.webp'],
["title" => "Asphalt", "details" => "Bangla Construction Limited. specialises in professional asphalt services to provide durable and smooth surfaces for your driveways, parking lots, and roads. Our skilled team uses high-quality asphalt materials and precise techniques to ensure long-lasting results that withstand heavy traffic and harsh weather conditions. Whether it's a residential or commercial project, trust us to deliver reliable asphalt solutions that enhance the functionality and aesthetics of your property.", "image" =>
'frontend/image/services/asphalt.webp'],
["title" => "Pavings", "details" => "Bangla Construction Limited. specialises in professional paving services, crafting elegant and durable surfaces for your outdoor areas. Our experienced team uses premium paving materials and meticulous installation methods to create stunning driveways, pathways, and patios that enhance your property's appeal and functionality. Whether it's for residential or commercial projects, rely on us to deliver high-quality paving solutions that stand the test of time.", "image" =>
'frontend/image/services/Pavings.webp']
];
@endphp


<section id="services" class="services">
    <div class="section-header">
        <h2>Our Services</h2>
    </div>
    <div class="container">
        <div class="swiper services-slider mt-lg-5 mt-4">
            <div class="swiper-wrapper">
                @foreach ($heroServices as $service => $value)
                <div class="swiper-slide">
                    <div class="services-card position-relative">
                        <div class="services-text position-relative">
                            <div class="position-absolute">
                                <h3>{{$value['title']}}</h3>
                                <p>{{Str::limit($value['details'], 120)}}</p>
                            </div>
                        </div>
                        <div class="services-img position-absolute">
                            <img src={{$value['image']}} class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mt-5 ms-lg-5">
            <a href="{{ route('public.services') }}">
                <button class="btn services-btn">Explore More<span class="ms-1">
                        <i class="fa-solid fa-arrow-right"></i></span>
                </button>
            </a>
        </div>
    </div>
</section>


@push('scripts')
<script>
    new Swiper(".services-slider", {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    },
    breakpoints: {
      568: {
        slidesPerView: 1,
        spaceBetween: 0
      },
      767: {
        slidesPerView: 2,
        spaceBetween: 5
      },
      993: {
        slidesPerView: 3,
        spaceBetween: 0
      },
      1400: {
        slidesPerView: 3,
        spaceBetween: 100
      }
    }

  });
</script>
@endpush