<?php

use App\Models\SelectClass;

$sc = new SelectClass();

// $galleries1 = DB::table('galleries')
//     ->orderBy('id', 'desc')
//     ->take(7)
//     ->get();
$galleries1 = DB::table('galleries')
->orderBy('id', 'desc')
->take(7)
->get();
?>
@include('include.header')
<!--========NAV ENDS==============-->
<!--========CONTACT US BANNER=======--->
<div class="contactus-banner">
    <div class="banner-contact-heading">
        <h2>Gallary {{ request()->title }}</h2>

    </div>
</div>


<!--========CONTACT US BANNER ENDS=======--->

<!--========CONTACT US FOR STARTS=========-->

<div style="background-color: #e3f2fdce;">
    <div class="margin-auto-width">
        <div class="gallary">
            @foreach ($galleries1 as $gallery)
            <div class="gal-img">
                <a href="{{asset($gallery->image)}}" data-lightbox="mygellary"> <img src="{{asset($gallery->image)}}"></a>
                <div class="gallery-overlay">
                    <div class="overlay-content">
                        <h5>{!! $gallery->caption !!}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>


@include('include.footer')
</body>



</html>