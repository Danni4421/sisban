@extends('layouts.guest')

@section('content')
    <!-- ======= Hero Section ======= -->
    @livewire('guest.hero')
    <!-- End Hero Section -->
    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            @livewire('guest.about')
        </section>
        <!-- End About Section -->

        <!-- ======= Features Section ======= -->
        <section id="data-rt" class="features">
            <div class="container px-lg-0 px-5">
                <div class="section-title" data-aos="fade-up">
                    <p>RT DI RW 07</p>
                </div>

                @livewire('guest.data-rt')
        </section>
        <!-- End Features Section -->

        {{-- Tipe Bansos --}}
        <div class="container">
            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Jenis</h2>
                <p>Bantuan Sosial</p>
            </div>
        </div>

        @livewire('guest.bansos-types')
        {{-- End Tipe Bansos --}}

        <!-- ======= Panduan Section ======= -->
        <div class="container guide p-4 my-3" id="panduan-pengajuan">
            <div class="section-title" data-aos="fade-up">
                <h2>Penduan Pengajuan</h2>
                <p>Bantuan Sosial</p>
            </div>

            @livewire('guest.guide-aplicant')
        </div>
        <!-- End Panduan Section -->

        <!-- ======= Pinjam Section ======= -->
        <section id="pengajuan" class="testimonials">
            <div class="container">

                <div class="Testimonials swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <h3>Ingin Mengajukan Bantuan Sosial?</h3>
                                <h4>Jangan Lupa Baca Syarat dan Panduan Terlebih Dahulu</h4>
                                <a href="{{ url('pengajuan') }}">
                                    <button type="button" class="btn btn-main">
                                        Ajukan Bantuan Sosial
                                    </button>
                                </a>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <section id="denah">
            @livewire('guest.map')
        </section>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/guest/guide.css') }}">
@endpush
