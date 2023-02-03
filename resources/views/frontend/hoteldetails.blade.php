@include('include.header')
<!--========CONTACT US BANNER=======--->
<div class="contactus-banner">
    <div class="banner-contact-heading">
        <h2>{{@$childcontentdetails[0]->child_title }}</h2>
    </div>
</div>
<div style="background-color: #e3f2fdce;">
    <div class="margin-auto-width">
        <div class="room-details-gallery">
            <div class="room-pic-details">
                <div class="gallary-photo-slider">
                    <div class="main-slider">
                        @foreach($galleries as $gallery)
                        <img src="{{asset('/'.$gallery->image)}}" alt="">
                        @endforeach
                    </div>

                    <div class="thumbs">
                        @foreach($galleries as $gallery)
                        <img src="{{asset('/'.$gallery->image)}}" alt="">
                        @endforeach
                    </div>


                </div>

                <div class="book-detail">
                    <h1>{{@$childcontentdetails[0]->child_title }}</h1>
                    <p>
                        <Strong style="color: #f40873; font-size: 20px;">Nrs. {{@$childcontentdetails[0]->price }} per Night</Strong>
                    </p>
                    <div class="room-facilities">
                        <p><i class="ri-hotel-bed-line"></i><span><strong>{{@$childcontentdetails[0]->bedsize }}</strong></span>
                        </p>&nbsp;
                    </div>
                    <div class="room-facilities">
                        <p><i class="ri-user-line"></i> <span><strong>{{@$childcontentdetails[0]->total_no_of_persons }} Max Guests</strong></span>
                        </p>
                    </div>
                    <div class="room-facilities">
                        <p><i class="ri-wifi-line"></i> <span><strong>Free Wifi</strong></span>
                        </p>
                    </div>
                    <div class="book-submit">
                        <input type="submit" value="Book Room">
                    </div>
                </div>
            </div>
            <div class="room-info-details">
                <p> {!! @$childcontentdetails[0]->text ?? '' !!}</p>

            </div>
        </div>

        <div class="room-details-gallery">
            <div class="other-rooms">
                <h1>OTHER ROOMS</h1>
                <div class="rooms-box">
                    <div class="other-room-box">
                        <div class="other-room-img">
                            <img src="{{asset('image/room/room2.jpg')}}">
                        </div>
                        <div class="other-room-details">
                            <h3>Nrs. 3,000 / Night</h3>

                            <h4>Super Kings Room</h4>


                            <div class="room-facilities">
                                <p><i class="ri-hotel-bed-line"></i><span><strong>1 King Size Bed</strong></span>
                                </p>
                                <p><i class="ri-user-line"></i> <span><strong>2 - 5 Guests</strong></span>
                                </p>
                            </div>

                            <div class="book-submit" style="width: 100%; text-align: right;">
                                <input type="submit" value="Check Room">
                            </div>
                        </div>

                    </div>
                    <div class="other-room-box">
                        <div class="other-room-img">
                            <img src="{{asset('image/room/room1.jpeg')}}">
                        </div>
                        <div class="other-room-details">
                            <h3>Nrs. 3,000 / Night</h3>

                            <h4>Super Kings Room</h4>


                            <div class="room-facilities">
                                <p><i class="ri-hotel-bed-line"></i><span><strong>1 King Size Bed</strong></span>
                                </p>
                                <p><i class="ri-user-line"></i> <span><strong>2 - 5 Guests</strong></span>
                                </p>
                            </div>
                            <div class="book-submit" style="width: 100%; text-align: right;">
                                <input type="submit" value="Check Room">
                            </div>

                        </div>
                    </div>
                    <div class="other-room-box">
                        <div class="other-room-img">
                            <img src="{{asset('image/room/room3.jpg')}}">
                        </div>
                        <div class="other-room-details">
                            <h3>Nrs. 3,000 / Night</h3>

                            <h4>Super Kings Room</h4>


                            <div class="room-facilities">
                                <p><i class="ri-hotel-bed-line"></i><span><strong>1 King Size Bed</strong></span>
                                </p>
                                <p><i class="ri-user-line"></i> <span><strong>2 - 5 Guests</strong></span>
                                </p>
                            </div>
                            <div class="book-submit" style="width: 100%; text-align: right;">
                                <input type="submit" value="Check Room">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('include.footer')
<!--=======FOOTER STARTS HERE===============-->

<!--=======FOOTER END HERE===============-->
<script src="{{asset('javascript/thumbnail-slider.js')}}"></script>
<script src="{{asset('javascript/slick.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('.main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.thumbs',
    });
    $('.thumbs').slick({
        slidesToShow: 3.5,
        slidesToScroll: 1,
        asNavFor: '.main-slider',
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    })
})
</script>

</body>



</html>