<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Slider</title>

  <style>
  .carousel-caption {
  font-size: 12px;
  font-style: italic;
  font-weight: bold;
  display: none; /*comment out to display captions*/
}

.carousel-control {
  text-shadow: 0;
}

.carousel-control.left {
  background-image: -webkit-linear-gradient(
    left,
    rgba(0, 0, 0, 0) 0,
    rgba(0, 0, 0, 0.0001) 100%
  );
  background-image: -o-linear-gradient(
    left,
    rgba(0, 0, 0, 0) 0,
    rgba(0, 0, 0, 0) 100%
  );
  background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(0, 0, 0, 0)),
    to(rgba(0, 0, 0, 00001))
  );
  background-image: linear-gradient(
    to right,
    rgba(0, 0, 0, 0) 0,
    rgba(0, 0, 0, 0) 100%
  ) !important;
}

.carousel-control.right {
  background-image: -webkit-linear-gradient(
    left,
    rgba(0, 0, 0, 0) 0,
    rgba(0, 0, 0, 0.0001) 100%
  );
  background-image: -o-linear-gradient(
    left,
    rgba(0, 0, 0, 0) 0,
    rgba(0, 0, 0, 0) 100%
  );
  background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(0, 0, 0, 0)),
    to(rgba(0, 0, 0, 00001))
  );
  background-image: linear-gradient(
    to right,
    rgba(0, 0, 0, 0) 0,
    rgba(0, 0, 0, 0) 100%
  ) !important;
}

.carousel-indicators {
  bottom: -40px !important;
}

.carousel-indicators li {
  border: 1px solid #d9d9d9 !important;
  border-radius: 10px !important;
  background-color: #d9d9d9 !important;
  width: 11px !important;
  height: 11px !important;
  margin-left: 3px !important;
  margin-right: 3px !important;
}

.carousel-indicators .active {
  border: 0px solid #869791 !important;
  border-radius: 10px !important;
  background-color: #869791 !important;
  width: 11px !important;
  height: 11px !important;
  margin-bottom: 1px !important;
}

  </style>

</head>

<body>
  
  <!--Bootstrap Responsive Full-Width Slider/Carousel Non-Touch with OwlCarousel style pagination. If you like my work, please credit author: www.action360.ca @action360ca Enjoy!-->


<div id="myCarousel" class="carousel slide" data-interval="2700" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="/images/sliders/CONTACT-1.jpg" width="100%">
      <div class="carousel-caption">
        <h3>First Slide</h3>
        <p>Caption goes here<br></p>
      </div>
    </div>
    <div class="item">
      <img src="/images/sliders/CONTACT-2.jpg" width="100%">
      <div class="carousel-caption">
        <h3>Second slide</h3>
        <p>Caption goes here</p>
      </div>
    </div>
    <div class="item">
      <img src="/images/sliders/CONTACT-3.jpg" width="100%">
      <div class="carousel-caption">
        <h3>Third slide</h3>
        <p>Caption goes here</p>
      </div>
    </div>
    <div class="item">
      <img src="/images/sliders/CONTACT-4.jpg" width="100%">
      <div class="carousel-caption">
        <h3>Fourth slide</h3>
        <p>Caption goes here</p>
      </div>
    </div>
    <div class="item">
      <img src="/images/sliders/CONTACT-5.jpg" width="100%">
      <div class="carousel-caption">
        <h3>Fifth slide</h3>
        <p>Caption goes here</p>
      </div>
    </div>
    <div class="item">
      <img src="/images/sliders/CONTACT-6.jpg" width="100%">
      <div class="carousel-caption">
        <h3>Fifth slide</h3>
        <p>Caption goes here</p>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
   


  </script>
</body>

</html>