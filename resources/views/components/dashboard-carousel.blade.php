<!-- Carousel Container -->
<div class="w-full mx-auto">
    <div class="relative overflow-hidden rounded-2xl">
        <!-- Carousel Slides -->
        <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
            <!-- Slide 1 -->
            <div class="relative flex-shrink-0 w-full">
                <div class="relative bg-gray-900 rounded-2xl overflow-hidden min-h-[300px] md:min-h-[160px]">
                    <div class="px-6 py-8 md:px-12 md:py-10">
                        <!-- Text Content -->
                        <div class="max-w-3xl lg:max-w-2xl">
                            <h2 class="mb-3 text-2xl font-bold text-white ">
                                Selamat datang
                            </h2>
                            <p class="text-sm leading-relaxed text-gray-300 md:text-base">
                                Brainys merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik
                            </p>
                        </div>
                    </div>

                    <!-- Image - Positioned Absolute Right -->
                    <img src="{{ URL('images/welcome3.png') }}" alt="Welcome Banner"
                        class="absolute right-0 hidden object-contain w-60 -bottom-1 lg:block">

                    <!-- Image - Positioned Absolute Right -->
                    <img src="{{ URL('images/welcome2.png') }}" alt="Welcome Banner"
                        class="object-contain mx-auto w-[265px] bottom-0 lg:hidden">
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="relative flex-shrink-0 w-full">
                <div class="relative bg-[#F2F2F7] rounded-2xl overflow-hidden min-h-[300px] md:min-h-[160px]">
                    <div class="px-6 py-8 md:px-12 md:py-10">
                        <!-- Text Content -->
                        <div class="max-w-4xl lg:max-w-3xl">
                            <h2 class="mb-3 text-2xl font-bold text-[#3758F9] ">
                                Upgrade Paket Sekarang, Bonus Kredit Menantimu!
                            </h2>
                            <p class="text-sm leading-relaxed text-[#222222] md:text-base ">
                                Dapatkan kredit ekstra setelah upgrade dan buat administrasi lebih efisien! <a
                                    href=""class="font-semibold text-[#3758F9] underlie">Upgrade
                                    Paket
                                    Sekarang↗</a>
                            </p>
                        </div>
                    </div>

                    <!-- Image - Positioned Absolute Right -->
                    <img src="{{ URL('images/welcome4.png') }}" alt="Welcome Banner"
                        class="absolute right-0 hidden object-contain w-60 -bottom-1 lg:block">

                    <!-- Image - Positioned Absolute Right -->
                    <img src="{{ URL('images/welcome4.png') }}" alt="Welcome Banner"
                        class="bottom-0 object-contain w-[265px] mx-auto lg:hidden">
                </div>
            </div>
        </div>

        <!-- Navigation Bullets -->
        <div class="flex items-center justify-center gap-3 py-6 bg-white">
            <button class="carousel-bullet w-3 h-3 rounded-full transition-all duration-300 bg-[#3758F9]" data-index="0"
                aria-label="Slide 1"></button>
            <button
                class="w-3 h-3 transition-all duration-300 bg-gray-300 rounded-full carousel-bullet hover:bg-gray-400"
                data-index="1" aria-label="Slide 2"></button>
        </div>
    </div>
</div>

<!-- Carousel Script -->
<script>
    const carousel = document.getElementById("carousel");
    const bullets = document.querySelectorAll(".carousel-bullet");
    let currentIndex = 0;
    let autoSlideTimer;

    function updateCarousel(index) {
        carousel.style.transform = `translateX(-${index * 100}%)`;

        bullets.forEach((bullet, i) => {
            if (i === index) {
                bullet.classList.add("bg-[#3758F9]");
                bullet.classList.remove("bg-gray-300", "hover:bg-gray-400");
            } else {
                bullet.classList.remove("bg-[#3758F9]");
                bullet.classList.add("bg-gray-300", "hover:bg-gray-400");
            }
        });

        currentIndex = index;
        resetAutoSlide();
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % bullets.length;
        updateCarousel(nextIndex);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(nextSlide, 5000); // Auto-slide setiap 5 detik
    }

    // Event listener untuk bullets
    bullets.forEach(bullet => {
        bullet.addEventListener("click", () => {
            updateCarousel(parseInt(bullet.dataset.index));
        });
    });

    // Keyboard navigation
    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") updateCarousel((currentIndex - 1 + bullets.length) % bullets.length);
        if (e.key === "ArrowRight") updateCarousel((currentIndex + 1) % bullets.length);
    });

    // Mulai auto-slide
    resetAutoSlide();
</script>

<style>
    * {
        box-sizing: border-box;
    }
</style>
