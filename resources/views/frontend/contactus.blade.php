@include('include.header')
    <!--========NAV ENDS==============-->
    <!--========CONTACT US BANNER=======--->
    <div class="contactus-banner">
        <div class="banner-contact-heading">
            <h2>Contact Us</h2>
            <p>Please leave your message below and one of our friendly team members will be in touch with you shortly. </p>
        </div>
    </div>


    <!--========CONTACT US BANNER ENDS=======--->

    <!--========CONTACT US FOR STARTS=========-->
    <div style="background-color: #e3f2fdce;">


        <div class="margin-auto-width">
            <section class="contactus" id="contactus">

                <div class="contbox" data-aos="fade-right" style="transition: 1.5s!important;">
                    <!----FORM BOX---->
                    <div class="contacts form" >
                        <h3>Send a Message</h3>
                        <form action="{{route('contactmessage')}}" method="POST">
                            @csrf
                            <div class="formbox">
                                <div class="row50">
                                    <div class="inputbox">
                                        <span>First Name</span>
                                        <input type="text"  name="firstname"placeholder="Enter Your Firstname">
                                    </div>
                                    <div class="inputbox">
                                        <span>Last Name</span>
                                        <input type="text" name="lastname" placeholder="Enter Your Lastname">
                                    </div>
                                </div>
                                <div class="row50">
                                    <div class="inputbox">
                                        <span>Email</span>
                                        <input type="email"  name="email" placeholder="Enter Your Email">
                                    </div>
                                </div>
                                <div class="row100">
                                    <div class="inputbox">
                                        <span>Message</span>
                                        <textarea  name="message"placeholder="Enter Your Message Here...."></textarea>
                                    </div>
                                </div>
                                <div class="row100">
                                    <div class="inputbox">
                                        <input type="submit" value="Send">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!----INFO BOX--->
                    <div class="contacts info" >
                        <h3>Contact Info</h3>
                        <div class="infobox">
                            <div>
                                <span><i class="fa-solid fa-location-dot"></i>

                        </span>
                                <p>Nayabazar 9 Pokhara<br>Nepal</p>
                            </div>
                            <div>
                                <span><i class="fa-solid fa-envelope"></i></span>
                                <p>gmailinfo@gmail.com</p>
                            </div>
                            <div>
                                <span><i class="fa-solid fa-phone"></i></span>
                                <p>+977 98347673483</p>
                            </div>
                            <!------Social Links----->
                            <ul class="sci">
                                <li>
                                    <a href="#"><i class="fa-brands fa-facebook"></i>

                            </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-twitter"></i>

                            </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-instagram"></i>

 

                            </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!----MAP-->
                    <div class="contacts map" >
                        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3515.8597565694104!2d83.97915955046159!3d28.21157318250029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1spokhara%20srijana%20chowk!5e0!3m2!1sen!2snp!4v1657279710367!5m2!1sen!2snp" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </section>
        </div>
    </div>
@include('include.footer')
    <!--=======FOOTER STARTS HERE===============-->

    <!--=======FOOTER END HERE===============-->

    <script src="{{asset('javascript/fad-animation.js')}}"></script>
    <script>
      AOS.init();
    </script>





</body>



</html>