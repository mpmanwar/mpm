

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    
    <script>
   
   // $("#features").on('click', function() {
    function featuresfun() {
       
    //alert('features');
    //window.location.href = "/";
    $("html, body").animate({ scrollTop: 450 }, 2000);
    
     }


function pricingfun() {
    //alert('pricingfun');
    //window.location.href = "/";
     $('html, body').animate({
        scrollTop: $("#pricing_div").offset().top
    }, 2000);
}
//});
    </script>


<div class="header">
<div class="wrapper1">

 <div class="main_logo"><a href="/"><img src="/img/logo.jpg" alt="" /></a></div>
 <div class="hdr_menu">
 
    <ul>
        <li><a href="/" {{ ($page_title == "Home")?'class="menu_active"':"" }}>home</a></li>
        <li ><a href="#" {{ ($page_title == "Features")?'  class="menu_active"':"" }} onclick="return featuresfun()"> Features </a></li>
        <li><a href="#" {{ ($page_title == "Pricing")?'class="menu_active"':"" }} onclick="return pricingfun()">Pricing</a></li>
        <li><a href="/contact" {{ ($page_title == "Contact")?'class="menu_active"':"" }}>Contact</a></li>
        <li><a href="/login">sign In</a></li>
        <li><a href="/admin-signup">Sign up</a></li>

 
    </ul>
    <div class="clr"></div>
 </div>
 <div class="clr"></div>
 
  </div>
</div>
