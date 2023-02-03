<?php

use App\Models\SelectClass;

$sc = new SelectClass();
$parentpageabout=$sc->selectParentpage('AboutPushp');
$serviceandfacilities=$sc->selectParentpage('ServiceandFacilities');
$similarblogs =  $sc->selectBlog();

// $SimilarTrips = $sc->SelectSimilarjobs($childcontentdetails->id);
?>
@include('include.header')
    <!--========CONTACT US BANNER=======--->
    <div class="contactus-banner">
        <div class="banner-contact-heading">
            <h2>About Us</h2>

        </div>
    </div>


    <!--========CONTACT US BANNER ENDS=======--->

    <!--========CONTACT US FOR STARTS=========-->
    <div style="background-color: #e3f2fdce;">
        <!--========ABOUT US===============-->
        <div class="section">
            <div class="margin-auto-width">
                <div class="container">
                    <div class="contentabout" data-aos="fade-right" style="transition: 1.5s!important;">
                        <div class="title-about">
                            <h1>Welcome To <span>Puspa Hotel !</span></h1>

                        </div>
                        <div class="content-aboutus">

                            <p>{!! substr(@$parentpageabout[0]->text, 0, 2000) !!}
                            </p>

                        </div>
                        <div class="title-about second-heading-title">
                            <h1>Our Rooms & Services</h1>

                        </div>
                        <div class="content-aboutus">

                            <p>{!! substr(@$serviceandfacilities[0]->text, 0, 2000) !!}
                            </p>

                        </div>
                        <div class="social-aboutus">
                            <a href=""><i class="fab fa-facebook-f" style="padding: 0px 10px 0px 0px;"></i></a>
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="aboutus-image about-us-page-resize" data-aos="fade-up" style="transition: 1.5s!important;">
                        <div class="aboutus-full-image">
                            <img src="{{ asset('uploads/thumbnailimg/' . @$parentpageabout[0]->Thumbnailimg) }}">
                        </div>

                        <div class="aboutus-half-image" style="display: inline-flex;">
                            <img src="{{ asset('uploads/thumbnailimg/' . @$serviceandfacilities[0]->Thumbnailimg) }}" style="width: 49%;">
                            <img src="{{ asset('uploads/thumbnailimg/' . @$serviceandfacilities[1]->Thumbnailimg) }}" style="width: 49%; margin-left: 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

 @include('include.footer')



</html>