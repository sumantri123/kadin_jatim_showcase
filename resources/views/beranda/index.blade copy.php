@extends('frontend.layout_home.default')

@push('style')

      <!-- Aditional Style CSS Here -->

@endpush


@section('content')

  <section class="call-to-action no-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-center text-md-left">
            <div class="call-to-action-text">
              <h3 class="action-title">BERITA TERKINI</h3>
            </div>
        </div><!-- Col end -->
        <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
            <div class="call-to-action-btn">
              <a class="btn btn-primary btn-sm" href="#">Selengkapnya</a>
            </div>
        </div><!-- col end -->
      </div><!-- row end -->
      <hr/>
      <div class="row">       
        <div class="col">
          <div class="card h-100">
            <!-- <img src="{{asset('frontend/images/news/service11.jpg')}}" class="card-img-top" alt="..."> -->
            <div class="card-body" >
              <h5 class="card-title">Program Studi Pendidikan Matematika Lolos Pendanaan Model CoE Kemdikbud RI</h5>
              <span class="modif_p">
                Lolos kembali dalam pendanaan program Merdeka Belajar - Kampus Merdeka dari Kementerian Pendidikan Dan Kebudayaan...
              </span><a href="javascript:;" class="btn btn-primary">Selengkapnya</a>
            </div>
            <div class="card-footer bg-white"> <small class="text-muted">6 April 2021</small></div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <!-- <img src="{{asset('frontend/images/news/service22.jpg')}}" class="card-img-top" alt="..."> -->
            <div class="card-body">
              <h5 class="card-title">3 Program Studi (Bimbingan dan Konseling, PGSD dan Pendidikan Khusus) Raih Bantuan Kerjasama Kurikulum MBKM dari Kemendibud RI</h5>
              <span class="modif_p">Direktorat Pembelajaran dan Kemahasiswaan, Direktorat Jenderal Pendidikan Tinggi membuka kesempatan kepada Perguruan Tinggi program Sarjana di jenis pendidikan akademik non kesehatan...</span>
                <a href="javascript:;" class="btn btn-primary">Selengkapnya</a>
            </div>
            <div class="card-footer bg-white"> <small class="text-muted">17 April 2021</small></div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <!-- <img src="{{asset('frontend/images/news/service33.jpg')}}" class="card-img-top" alt="..."> -->
            <div class="card-body">
              <h5 class="card-title">85 Mahasiswa dan 33 Dosen Lolos Program Kemendikbud RI</h5>
              <span class="modif_p">Kementerian Pendidikan dan Kebudayaan Direktorat Jendral Pendidikan Tinggi melalui Surat Tugas nomor 1547/E1/KP.04.00/2021 tertanggal 22 Maret 2021 tentang nama-nama Dosen untuk...</span>	<a href="javascript:;" class="btn btn-primary">Selengkapnya</a>
            </div>
            <div class="card-footer bg-white"> <small class="text-muted">Last updated 3 mins ago</small></div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <!-- <img src="{{asset('frontend/images/news/service44.jpg')}}" class="card-img-top" alt="..."> -->
            <div class="card-body">
              <h5 class="card-title">14 Perguruan Tinggi PGRI Se-Jawa Timur Menjalin Kerjasama Akademik</h5>
              <span class="modif_p">Universitas PGRI Adi Buana Surabaya, yang sejak tahun 1976 menjadikan PGRI sebagai bagian dari jati dirinya, dengan nama IKIP PGRI Sarmidi Mangunsarkoro Surabaya saat itu...</span>	<a href="javascript:;" class="btn btn-primary">Selengkapnya</a>
            </div>
            <div class="card-footer bg-white"> <small class="text-muted">Last updated 3 mins ago</small></div>
          </div>
        </div>
      </div>                  
    </div><!-- Container end -->
  </section><!-- Action end -->

  <section class="content">
    <div class="container">
      <div class="row">
          <div class="col-lg-6">
            <h3 class="border-title border-left">Safety</h3>

            <div class="accordion accordion-group accordion-classic" id="safety-accordion">
              <div class="card">
                <div class="card-header p-0 bg-transparent" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour"
                      aria-expanded="true" aria-controls="collapseFour">
                      Apa Itu Kampus Mengajar ? 
                    </button>
                  </h2>
                </div>

                <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#safety-accordion">                
                    <img loading="lazy" class="img-fluid" src="{{asset('frontend/images/content/g_1.jpg')}}" alt="testimonial">                
                </div>
              </div>
              <div class="card">
                <div class="card-header p-0 bg-transparent" id="headingFive">
                  <h2 class="mb-0">
                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                      data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Mengapa Kamu Harus Mendaftar Kampus Mengajar ?
                    </button>
                  </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#safety-accordion">
                  <img loading="lazy" class="img-fluid" src="{{asset('frontend/images/content/g_2.jpg')}}" alt="testimonial">                
                </div>
              </div>
              <div class="card">
                <div class="card-header p-0 bg-transparent" id="headingSix">
                  <h2 class="mb-0">
                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                      data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Bagaimana cara mendaftar program kegiatan?
                    </button>
                  </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                  data-parent="#safety-accordion">
                  <img loading="lazy" class="img-fluid" src="{{asset('frontend/images/content/g_3.jpg')}}" alt="testimonial">                
                </div>
              </div>
            </div>
            <!--/ Accordion end -->
          </div><!-- Col end -->

          <div class="col-lg-6 mt-5 mt-lg-0">

            <h3 class="column-title">Poster</h3>

            <div class="row all-clients">
              <img loading="lazy" class="img-fluid" src="{{asset('frontend/images/content/poster.jpg')}}" alt="testimonial">
                <!-- <div class="container">
                    <div class="box-slider-content">
                      <div class="box-slider-text">
                          <h2 class="box-slide-title">Leadership</h2>
                      </div>    
                    </div>
                </div> -->
            </div><!-- Clients row end -->

          </div><!-- Col end -->

      </div>
      <!--/ Content row end -->
    </div>
    <!--/ Container end -->
  </section><!-- Content end -->

  <section class="subscribe no-padding">
    <div class="container">
      <div class="row">
          <div class="col-lg-4">
            <div class="subscribe-call-to-acton">
                <h3>Can We Help?</h3>
                <h5 class="text-white">www.unipasby.ac.id</h5>
            </div>
          </div><!-- Col end -->

          <div class="col-lg-8">
            <div class="ts-newsletter row align-items-center">
                <div class="col-md-5 newsletter-introtext">
                  <h4 class="text-white mb-0">Newsletter Sign-up</h4>
                  <p class="text-white">Latest updates and news</p>
                </div>

                <div class="col-md-7 newsletter-form">
                  <form action="#" method="post">
                      <div class="form-group">
                        <label for="newsletter-email" class="content-hidden">Newsletter Email</label>
                        <input type="email" name="email" id="newsletter-email" class="form-control form-control-lg" placeholder="Your your email and hit enter" autocomplete="off">
                      </div>
                  </form>
                </div>
            </div><!-- Newsletter end -->
          </div><!-- Col end -->

      </div><!-- Content row end -->
    </div>
    <!--/ Container end -->
  </section>
  <!--/ subscribe end -->

@endsection

@push('scripts')

@endpush
