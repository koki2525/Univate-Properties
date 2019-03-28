@extends('master')

@section('title', 'Contact Us')

@section('description', 'Get in touch with Uni-Vate Properties to begin your journey into timeshare and your holiday portfolio.')

@section('keywords', 'Contact Uni-Vate Properties, get in touch with Uni-Vate, Uni-Vate Properties address, Uni-Vate Properties number')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Contact Us</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-4 mb-md-0">
            <p><strong>Send us a message</strong></p>
            <form id="mainForm" method="POST" action="/contact-us" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Name" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="cell" placeholder="Contact number" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="property" placeholder="Property" />
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="Message"></textarea>
                </div>

                <button class="btn btn-blue btn-lg" type="submit">SEND</button>
            </form>
        </div>
        <div class="col-md-4">

            <p>
                <strong>Physical Address</strong><br/>
                105 Lombardy Business Park<br/>
                Cnr. Graham and Cole Rd.<br/>
                Shere, Pretoria<br/>
                0084
            </p>

            <p>
                <i class="fas fa-envelope"></i>
                <a href="mailto:info@univateproperties.co.za">&nbsp;info@univateproperties.co.za</a><br/>
                <i class="fas fa-phone"></i>
                <a href="tel:+27124921238">&nbsp;+27&nbsp;(0)&nbsp;12&nbsp;492&nbsp;1238</a>
            </p>
            
        </div>
        <div class="col-md-4">

            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-page" data-href="https://www.facebook.com/univateproperties/" data-tabs="timeline" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/univateproperties/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/univateproperties/">Uni-Vate Properties</a></blockquote></div>
            
        </div>
    </div>
</div>

<!-- Contact Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content px-0 px-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Thank you</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>
                    Thank you for contacting us. We will contact you as soon as possible. 
                </p>

            </div>
        </div>
    </div>
</div>

<script>
    $('#thankyouModal').on('shown.bs.modal', function () {
        $('#contactModal').trigger('focus')
    })
</script>

@stop