
<link rel="stylesheet" href="{{ asset('http://univateproperties.co.za/css/header.css') }}">

<nav class="topnav" id="myTopnav">
  <a href="/"><img width="40%" src="http://test.univateproperties.co.za/images/UniVate_properties_png_logo.png"/></a>
  <a href="/">Home</a>
  <a href="/about">About</a>
  <div class="dropdown">
    <button class="dropbtn">Timeshare 
    </button>
    <div class="dropdown-content">
      <a href="/to-sell">To Sell</a>
      <a href="/to-buy">To Buy</a>
      <a href="/admin">Admin</a>
      <a href="/resort-upload">Resort Upload</a>
      <a href="/faqs">FAQs</a>    
    </div>
  </div>
</nav>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
