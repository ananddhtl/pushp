<?php

use App\Models\SelectClass;

$sc = new SelectClass();
$blogs = $sc->selectBlog();
$parentpageabout = $sc->selectParentpage('AboutPushp');
$clientreviews = $sc->SelectReview();
$messagefromchairman = $sc->selectSubHeading('About us');
$serviceandfacilities = $sc->selectParentpage('ServiceandFacilities');

//$selectfromparentpage = $sc->

?>
@php
$slider_images = DB::table('slider_images')->get();
$galleries1 = DB::table('galleries')
->orderBy('id', 'desc')
->take(7)
->get();

$blogs1 = DB::table('blogs')
->where('header','blog')
->orderBy('id', 'desc')
->take(7)
->get();


@endphp

@section('content')

@php $popupimage=DB::table('popup_images')->get(); @endphp
@include('include.header')
<style>
.book-calender form button[type="submit"] {
    background-color: #f40873;
    border: none;
    color: white;
    font-weight: 500;
    width: 23%;
    cursor: pointer;
    transition: 0.3s;
    font-size: 18px;
}

.book-calender form button[type="submit"]:hover {
    background-color: #a0074c;
}
</style>
<!--========Image SLider===============-->
<section class="home-slider">
    <div class="slider-back">
        @foreach ($slider_images as $slider)
        <div class="slide active"
            style="background-image:  linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{$slider->image}}')">
            <div class="slider-container">
                <div class="caption">
                    <h2>{{ $slider->name }}</h2>
                    <h5>{!! $slider->caption !!}</h5>

                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- controls  -->
    <div class="controls">
        <div class="back-button"><i class="fa-solid fa-angle-left"></i></div>
        <div class="next-button"><i class="fa-solid fa-angle-right"></i></div>
    </div>

    <!-- indicators -->
    <div class="indicator">
    </div>

</section>
<!--========Image Slider===============-->

<!--========ROOMS TYPES===============-->
<div class="room-section">
    <!-- <div class="margin-auto-width" data-aos="fade-left" style="transition: 1.7s!important;"> -->
    <div class="margin-auto-width" style="overflow-x: hidden;">
        <div class="book-calender">
            <form action="/checkin" class="input-calender-form">
                <input type="date" name="setTodaysDate">
                <input type="date" name="setTodaysDate">
                <button type="submit">Submit</button>
            </form>
            <script>
            window.onload = function() {
                var today = new Date().toISOString().split('T')[0];
                document.getElementsByName("setTodaysDate")[0].setAttribute('min', today);
            }
            </script>
        </div>

        <div class="title-room" id="txtDate">
            <h1>PUSPA HOTEL</h1>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, voluptates cupiditate. Atque fuga hic
                deleniti, maiores doloribus ea eligendi temporibus, ducimus ab odio repellendus. Necessitatibus maxime a
                officia officiis nobis.</p>
        </div>
        <div class="room-quality">
            <div class="img-hover-zoom">
                @if(@$contentdetails[0]->Thumbnailimg)
                <img src="{{ asset('uploads/childcontentimg/'.@$contentdetails[0]->Thumbnailimg ) }}"
                    class="responsive">
                @endif
                <div class="room-information">
                    <h5>{{@$contentdetails[0]->child_title }}</h5>
                </div>
            </div>
            <div class="img-hover-zoom">
                @if(@$contentdetails[1]->Thumbnailimg)
                <img src="{{ asset('uploads/childcontentimg/'.@$contentdetails[1]->Thumbnailimg ) }}"
                    class="responsive">
                @endif
                <div class="room-information">
                    <h5>{{@$contentdetails[1]->child_title }}</h5>
                </div>
            </div>
            <div class="img-hover-zoom">
                @if(@$contentdetails[2]->Thumbnailimg)
                <img src="{{ asset('uploads/childcontentimg/'.@$contentdetails[2]->Thumbnailimg ) }}"
                    class="responsive">
                @endif
                <div class="room-information">
                    <h5>{{@$contentdetails[2]->child_title }}</h5>
                </div>
            </div>
            <div class="img-hover-zoom">
                @if(@$contentdetails[3]->Thumbnailimg)
                <img src="{{ asset('uploads/childcontentimg/'.@$contentdetails[3]->Thumbnailimg ) }}"
                    class="responsive">
                @endif
                <div class="room-information">
                    <h5>{{@$contentdetails[3]->child_title }}</h5>
                </div>
            </div>
            <div class="img-hover-zoom">
                @if(@$contentdetails[4]->Thumbnailimg)
                <img src="{{ asset('uploads/childcontentimg/'.@$contentdetails[4]->Thumbnailimg ) }}"
                    class="responsive">
                @endif
                <div class="room-information">
                    <h5>{{@$contentdetails[4]->child_title }}</h5>
                </div>
            </div>
            <div class="img-hover-zoom">
                @if(@$contentdetails[5]->Thumbnailimg)
                <img src="{{ asset('uploads/childcontentimg/'.@$contentdetails[5]->Thumbnailimg ) }}"
                    class="responsive">
                @endif
                <div class="room-information">
                    <h5>{{@$contentdetails[5]->child_title }}</h5>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!--========ROOMS TYPES ENDS===============-->

<!--========ABOUT US===============-->
<div class="section">
    <!-- <div class="margin-auto-width" data-aos="fade-right" style="transition: 1.7s!important;"> -->
    <div class="margin-auto-width">
        <div class="container">
            <div class="contentabout">
                <div class="title-about">
                    <h1>About Us</h1>

                </div>
                <div class="content-aboutus">

                    <p>{!! substr(@$parentpageabout[0]->text, 0, 2000) !!}</p>

                </div>
                <div class="social-aboutus">
                    <a href=""><i class="fab fa-facebook-f" style="padding: 0px 10px 0px 0px;"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                </div>
                <a href="/aboutus/{{ @$parentpageabout[0]->id }}"><button class="read-more-btn"> Read
                        More...</button></a>
            </div>
            <div class="aboutus-image">
                <img src="{{ asset('uploads/thumbnailimg/' . @$parentpageabout[0]->Thumbnailimg) }}">
            </div>

        </div>
    </div>
</div>
<!--========ABOUT US ENDS===============-->

<!--========SERVICES===============-->
<div class="section bg-black">
    <!-- <div class="margin-auto-width" data-aos="fade-left" style="transition: 1.7s!important;"> -->
    <div class="margin-auto-width">
        <div class="service-cont">
            <div class="services-images">
                <div class="service-img-1">
                    <img src="{{ asset('uploads/thumbnailimg/' . @$serviceandfacilities[0]->Thumbnailimg) }}" alt="">
                </div>
                <div class="service-img-2">
                    <div class="sub-image">
                        <img src="{{ asset('uploads/thumbnailimg/' . @$serviceandfacilities[1]->Thumbnailimg) }}"
                            alt="">
                    </div>
                    <div class="sub-image">
                        <img src="{{ asset('uploads/thumbnailimg/' . @$serviceandfacilities[2]->Thumbnailimg) }}"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="services-icons">
                <div class="services-heading">
                    <h1>SERVICES & FACILITIES</h1>

                    <p>{!! substr(@$serviceandfacilities[0]->text, 0, 2000) !!}
                    </p>
                </div>
                <div class="icons-serv">
                    <div class="ico-ser">
                        <i class="ri-time-line"></i> <span>24 hrs Security</span>
                    </div>
                    <div class="ico-ser">
                        <i class="fa-solid fa-leaf"></i> <span>Garden</span>
                    </div>
                    <div class="ico-ser">
                        <i class="fa-solid fa-wifi"></i><span>High Speed Wifi</span>
                    </div>
                    <div class="ico-ser">
                        <i class="fa-solid fa-martini-glass"></i><span>Bar</span>
                    </div>
                    <div class="ico-ser">
                        <i class="fa-solid fa-square-parking"></i><span>Parking Spot</span>
                    </div>
                    <div class="ico-ser">
                        <i class="fa-solid fa-spa"></i><span> Spa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========SERVICES ENDS HERE===============-->

<!--========TESTOMONIALS STARTS===============-->
<div class="test-container">
    <!-- <div class="testimonial mySwiper" data-aos="fade-right" style="transition: 1.7s!important;"> -->
    <div class="testimonial mySwiper">
        <div class="testi-content swiper-wrapper">
            @foreach ($clientreviews as $clientreview)
            <div class="slide swiper-slide">

                <img src="uploads/testimonial/{{ $clientreview->image }}" alt="" class="image" />
                <p>
                    {!! $clientreview->description !!}
                </p>

                <i class="bx bxs-quote-alt-left quote-icon"></i>

                <div class="details">
                    <span class="name">{{ $clientreview->name }}</span>
                    <span class="job">{{$clientreview->designation}}</span>
                </div>

            </div>
            @endforeach

        </div>
        <div class="swiper-button-next nav-btn"></div>
        <div class="swiper-button-prev nav-btn"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!--========TESTOMONIALS ENDS===============-->


@include('include.footer')

<script>
$(".testmonial_slider_area").owlCarousel({
    autoplay: true,
    slideSpeed: 1000,
    items: 3,
    loop: true,
    nav: true,
    navText: ['<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>'],
    margin: 30,
    dots: true,
    responsive: {
        320: {
            items: 1
        },
        767: {
            items: 2
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }

});
</script>

</html>