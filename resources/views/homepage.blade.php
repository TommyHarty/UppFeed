@extends('layouts.home')

@section('content')

    <div class="row above-fold-wrap not-dashboard">
        <div class="col-md-12">
            <div class="intro text-center">
                <h1>What if your restaurant could have a custom built mobile app in just 2 weeks?</h1>
                <h2><a href="{{ route('register') }}">Get started</a> now and your customers could be using your app by {{ $weeks }}!</h2>
                <a class="btn btn-primary" href="{{ route('register') }}">
                    <span class="not-on-mobile"><i class="fa fa-arrow-right" aria-hidden="true"></i> Yes! My Restaurant needs a mobile app!</span>
                    <span class="mobile-only"><i class="fa fa-arrow-right" aria-hidden="true"></i> Get Started!</span>
                </a>

                <div class="row">
                    <div class="col-md-12">
                        <div class="home-banner">
                            <img src="/images/uppfeed-mobile-apps.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="features-wrap pricing-wrap">
        <div class="row">
            <div class="col-xs-12">
                <div class="pricing-box">
                    <div class="pricing-header">£149/month</div>
                    <div class="pricing-text">No contract. Cancel any time.</div>
                </div>
            </div>
            <div class="above-fold-wrap pricing-button-wrap">
                <a class="btn btn-primary" href="{{ route('register') }}">
                    <span class=""><i class="fa fa-arrow-right" aria-hidden="true"></i> Get Started!</span>
                </a>
            </div>
        </div>
    </div>

    <div class="features-wrap" id="features">
        <div class="row text-center features not-dashboard">
            <div class="col-xs-12">
                <div class="pricing-box">
                    <div style="margin-top:42px;" class="pricing-header">Your App</div>
                    <div class="pricing-text">Custom design. Amazing features.</div>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#design"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Design Demo</a>
                    </div>
                    <div class="tablet-only" style="width:100%;height:30px;"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <img src="/images/notifications.png" alt="">
                    <h4>Push Notifications</h4>
                    <p>Send unlimited notifications straight to your customer's phones</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#updates">
                        <img src="/images/updates.png" alt="">
                        <h4>Real-Time Updates</h4>
                        <p>Update the content of your app with our cutting edge admin dashboard</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#updates"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Updates Demo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#reservations">
                        <img src="/images/reservations.png" alt="">
                        <h4>Reservation Enquiries</h4>
                        <p>Customers can use your app to make table reservation enquiries</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#reservations"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Reservations Demo</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center features not-dashboard">
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#reviews">
                        <img src="/images/reviews.png" alt="">
                        <h4>Customer Reviews</h4>
                        <p>Customers can leave reviews on your app, increasing social validation</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#reviews"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Reviews Demo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#menus">
                        <img src="/images/menus.png" alt="">
                        <h4>Unlimited Menus</h4>
                        <p>Add an unlimited amount of menus and menu items to your app</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#menus"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Menus Demo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#offers">
                        <img src="/images/launch-white.png" alt="">
                        <h4>Special Offers</h4>
                        <p>Keep your customers up-to-date with your latest special offers</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#offers"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Offers Demo</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center features not-dashboard">
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#galleries">
                        <img src="/images/menus.png" alt="">
                        <h4>Image Galleries</h4>
                        <p>Add an unlimited amount of images and image galleries to your app</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#galleries"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Galleries Demo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <a href="" data-toggle="modal" data-target="#events">
                        <img src="/images/reservations.png" alt="">
                        <h4>Upcoming Events</h4>
                        <p>Keep your customers up-to-date with your upcoming events</p>
                    </a>
                    <div class="pricing-modal">
                        <a href="" data-toggle="modal" data-target="#events"><i class="fa fa-play-circle-o" aria-hidden="true"></i> View Events Demo</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <img src="/images/retargeting.png" alt="">
                    <h4>Subscribers</h4>
                    <p>Build a list of your app users for remarketing purposes</p>
                </div>
            </div>
        </div>
    </div>

    <div class="features-wrap pricing-wrap">
        <div class="row">
            <div class="col-xs-12">
                <div class="pricing-box">
                    <div class="pricing-header">£149/month</div>
                    <div class="pricing-text">No contract. Cancel any time.</div>
                </div>
            </div>
            <div class="above-fold-wrap pricing-button-wrap">
                <a class="btn btn-primary" href="{{ route('register') }}">
                    <span class=""><i class="fa fa-arrow-right" aria-hidden="true"></i> I'm Ready!</span>
                </a>
            </div>
        </div>
    </div>

    <div class="your-designer-wrap">
        <div class="row">
            <div class="col-xs-12">
                <div class="pricing-box">
                    <div class="pricing-header">Your Designer</div>
                    <div class="pricing-text">Introducing Tommy Harty.</div>
                </div>
            </div>
            <div class="col-xs-12 avatar avatar-home">
                <img src="/images/profile.png" alt="">
                <p>Hi, I'm Tommy Harty, and I designed and built UppFeed.co.uk</p>
                <p>I have spent the past five years working in digital design and marketing, including multiple roles with seven-figure businesses.</p>
                <p>Next, I want to build a mobile app for your Restaurant!</p>
                <p>I built UppFeed to makes this process efficient, professional and affordable.</p>
                <a target="_blank" href="https://www.instagram.com/tommyatuppfeed/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a target="_blank" href="https://www.facebook.com/tommy.harty.77920"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a target="_blank" href="https://www.youtube.com/channel/UCTgt5igbMKnXht88POotVMw"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a target="_blank" href="http://www.tommyharty.com/"><i class="fa fa-link" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

@endsection

<!-- Design Modal -->
<div id="design" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your App Design</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/IyfC_TB0kCQ" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/IyfC_TB0kCQ" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Updates Modal -->
<div id="updates" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Real-Time Updates</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/zjQws6dXlP4" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/zjQws6dXlP4" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Reservations Modal -->
<div id="reservations" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reservation Enquiries</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/HINC-paGtQs" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/HINC-paGtQs" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Reviews Modal -->
<div id="reviews" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Customer Reviews</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/xF-5ml1GLcw" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/xF-5ml1GLcw" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Menus Modal -->
<div id="menus" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Unlimited Menus</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/7ndzwkU9wf0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/7ndzwkU9wf0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Offers Modal -->
<div id="offers" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Special Offers</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/uMz52THrHdk" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/uMz52THrHdk" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Galleries Modal -->
<div id="galleries" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Image Galleries</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/mPgMCu1nSEA" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/mPgMCu1nSEA" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Events Modal -->
<div id="events" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upcoming Events</h4>
            </div>
            <div class="modal-body text-center">
                <div class="not-on-mobile">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/KdlS0iHCAto" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="mobile-only">
                    <iframe width="280" height="157" src="https://www.youtube.com/embed/KdlS0iHCAto" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
