@include('include.header')
<!--========NAV ENDS==============-->
<!--========CONTACT US BANNER=======--->
<div class="contactus-banner">
    <div class="banner-contact-heading">
        <h1>Book Now</h1>

    </div>
</div>


<!--========CONTACT US BANNER ENDS=======--->

<!--========CONTACT US FOR STARTS=========-->
<div style="background-color: #e3f2fdce;">
    <div class="margin-auto-width" style="display: flex; flex-wrap: wrap;">
        <div class="check-out-form" data-aos="fade-right" style="transition: 1.5s!important;">
            <div class="form-checkout">
                <form action="{{route('contactpost')}}" method="POST">
                    @csrf
                    <div class="form-container">
                        <label for="" class="label-check-out">Form:</label>
                        <input type="date" name="from" placeholder="">
                    </div>
                    <div class="form-container">
                        <label for="" class="label-check-out">To:</label>
                        <input type="date" name="to" placeholder="">
                    </div>
                    <div class="form-container">
                        <label for="" class="label-check-out">First Name :</label>
                        <input type="text" name="firstname" placeholder="Enter Your First Name">
                    </div>
                    <div class="form-container">
                        <label for="" class="label-check-out">Last Name :</label>
                        <input type="text" name="lastname" placeholder="Enter Your Last Name">
                    </div>
                    <div class="form-container">
                        <label for="" class="label-check-out">Email :</label>
                        <input type="Email" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="form-container">
                        <label for="" class="label-check-out">Address :</label>
                        <input type="text" name="address" placeholder="Enter Address">
                    </div>
                    <div class="form-container">
                        <label for="" class="label-check-out">Mobile No. :</label>
                        <input type="text" name="mobilenumber" placeholder="Enter Your Mobile No.">
                    </div>

                    <div class="textfield">
                        <label for="" class="label-check-out">Message :</label>
                        <textarea name="message" placeholder="Message"></textarea>
                    </div>
  

                    <input type="submit" value="Reserve Room" class="reserve-submit">

                </form>
            </div>
        </div>
        <div class="bill-check-out" data-aos="fade-left" style="transition: 1.5s!important;">
            <div class="bill-receipt">
                <div class="bill-heading">
                    <div class="hed-bill">
                        <h3>
                            Room Name : <span>Honeymoon Suit Room</span>
                        </h3>
                    </div>
                    <div class="hed-bill">
                        <h3>
                            Qualtity : <span>1</span>
                        </h3>
                    </div>
                    <div class="hed-bill">
                        <h3>
                            Amount (NRP) : <span> Rs. 2,000</span>
                        </h3>
                    </div>
                    <div class="hed-bill">
                        <h3>
                            Tax (10%) : <span> Rs.200 </span>
                        </h3>
                    </div>
                    <div class="hed-bill">
                        <h3>
                            Total Amount : <span> Rs. 2,200</span>
                        </h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@include('include.footer')
</body>



</html>