<?php

use App\Models\SelectClass;

$sc = new SelectClass();

$AboutUs = $sc->selectSubHeading('About us');
$similarblogs =  $sc->selectBlog();

// $SimilarTrips = $sc->SelectSimilarjobs($childcontentdetails->id);
?>
<!--=======FOOTER STARTS HERE===============-->
<div class="footer">
    <div class="whole-footer">
        <div class="top-footer">
            <div class="margin-auto-width">
                <div class="service-cont">
                    <div class="logo">
                        <a href="#">
                            <img src="{{asset('image/logo.png')}}">
                        </a>
                    </div>
                    <div class="footer-icons">
                        <div class="f-icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="f-icon">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <div class="f-icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mid-footer">
            <div class="margin-auto-width">
                <div class="service-cont fot-cont-colm">
                    <div class="fot-col">
                        <div class="col-head">
                            <h3>
                                About Puspa
                            </h3>
                        </div>
                        <div class="fot-par">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt esse nesciunt
                                reprehenderit aperiam magni veritatis illo facilis nam distinctio, optio tempore
                                laboriosam fugiat itaque nemo sint quam neque! Eveniet, fugiat.</p>
                        </div>
                    </div>
                    <div class="fot-col col-new">
                        <div class=" col-head ">
                            <h3>
                                Quick Links
                            </h3>
                        </div>
                        <div class="fot-par">
                            <ul>
                                <a href="">
                                    <li>Home</li>
                                </a>
                                <a href="">
                                    <li>Rooms</li>
                                </a>
                                <a href="">
                                    <li>Contact Us</li>
                                </a>
                                <a href="">
                                    <li>Services</li>
                                </a>
                            </ul>
                        </div>

                    </div>
                    <div class="fot-col col-new">
                        <div class=" col-head ">
                            <h3>
                                Room Types
                            </h3>
                        </div>
                        @foreach ($AboutUs as $About)
                        <div class="fot-par">
                            <ul>
                                <a href="{{ url('contentdetails/') . '/' . $About->id }}">{{ $About->child_title }}</a>
                                
                            </ul>
                        </div>
                        @endforeach

                    </div>
                    <div class="fot-col col-new">
                        <div class=" col-head ">
                            <h3>
                                Help & Support
                            </h3>
                        </div>
                        <div class="fot-par">
                            <ul>
                                <li> Call Us : +977 9824194343</li>
                                <li>Address : Nayabazar - 09, Pokhara</li>
                                <li>Email Address : info@gmail.com</li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-footer">
            <div class="margin-auto-width">
                <div class="service-cont">
                    <p>© 2022 Puspa. All rights reserved | Designed & Developed by <a href="">Tuki Soft</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--=======FOOTER END HERE===============-->


<script src="{{asset('javascript/swiper-bundle.min.js')}}"></script>
<script src="{{asset('javascript/script.js')}}"></script>
<script src="{{asset('javascript/photoslider.js')}}"></script>
<script src="{{asset('javascript/fad-animation.js')}}"></script>
<script>
AOS.init();
</script>

</body>