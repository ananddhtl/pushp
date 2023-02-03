<?php

use App\Models\SelectClass;

$sc = new SelectClass();

$AboutUs = $sc->selectSubHeading('About us');
$similarblogs =  $sc->selectBlog();

// $SimilarTrips = $sc->SelectSimilarjobs($childcontentdetails->id);
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Puspa</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/test.css')}}">
    <script src="https://kit.fontawesome.com/c8371491b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/fade-animation.css')}}">
</head>

<!-----Photo slider STARTS HERE------>

<body>
    <!--========NAV BAR===============-->
    <div class="wrapper">
        <div class="top-bar">
            <div class="margin-auto-width">
                <div class="bar-information">
                    <a class="phone-info"> <i class="fa-solid fa-phone"></i> +977 9824194545</a>
                    <a class="address-info"><i class="fa-solid fa-location-dot"></i> Nayabazar- Pokhara, 9</a>
                </div>
            </div>
        </div>

    </div>
    <div class="wrapper sticky">

        <div class="margin-auto-width">

            <nav>
                <input type="checkbox" id="show-search">
                <input type="checkbox" id="show-menu">
                <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
                <div class="content">
                    <div class="logo">
                        <a href="/">
                            <img src="{{asset('image/logo.png')}}">
                        </a>
                    </div>
                    <ul class="links">
                        <label for="show-menu" class="menu-icon another-icon"><i class="fa-solid fa-xmark"></i></label>
                        <li><a href="/" class="active main-anchor"><i class="fa-solid fa-house"></i></a></li>
                        <li><a href="/aboutus" class="main-anchor">About Us</a></li>
                        <li>
                            <a href="/hoteldetails" class="desktop-link main-anchor">Rooms <i
                                    class="fa-solid fa-caret-down"></i></a>
                            <input type="checkbox" id="show-features">
                            <label for="show-features">Features</label>
                            <ul>
                                @foreach ($AboutUs as $About)
                                <li><a
                                        href="{{ url('contentdetails/') . '/' . $About->id }}">{{ $About->child_title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        
                        <!-- <li>
                            <a href="#" class="desktop-link main-anchor">Services <i class="fa-solid fa-caret-down"></i></a>
                            <input type="checkbox" id="show-services">
                            <label for="show-services">Services</label>
                            <ul>
                                <li><a href="#">Drop Menu 1</a></li>
                                <li><a href="#">Drop Menu 2</a></li>
                                <li><a href="#">Drop Menu 3</a></li>
                                <li>
                                    <a href="#" class="desktop-link">More Items <i class="fa-solid fa-caret-right"></i></a>
                                    <input type="checkbox" id="show-items">
                                    <label for="show-items">More Items </label>
                                    <ul>
                                        <li><a href="#">Sub Menu 1</a></li>
                                        <li><a href="#">Sub Menu 2</a></li>
                                        <li><a href="#">Sub Menu 3</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                        <li><a href="/gallery" class="main-anchor">Gallery</a></li>
                        <li><a href="/contactus" class="main-anchor"> Contact Us </a></li>
                    </ul>
                </div>
                <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
                <form action="#" class="search-box">
                    <input type="text" placeholder="Type Something to Search..." required>
                    <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
                </form>
            </nav>

        </div>
    </div>
    <!--========NAV ENDS==============-->