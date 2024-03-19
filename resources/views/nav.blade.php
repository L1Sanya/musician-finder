<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Display page</title>
    <!-- Basic page styling -->
    <link rel="stylesheet" type="text/css" href="base.css">
    <!-- User styling -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="navbar-wrapper">
    <nav>
        <div class="content">
            <ul>
                <li><a href="place-announcement"><p>Place announcement</p></a></li>
                <li><a href="view-announcements"><p>Announcements</p></a></li>
                <li><a href="resume"><p>Custom resume</p></a></li>
            </ul>
            <ul class="right">
                <li><a href="{{ route('login') }}"><p>Log in</p></a></li>
                <li class="action-item"><a href="register"><p>Sign up</p></a></li>
            </ul>
        </div>
    </nav>
</div>

<body>
@yield ('content')
</body>

<script>
    $(function() {

        $(window).scroll(function() {
            /************************
             * Paralax image effect *
             ************************/
            var FACTOR = 0.5;
            var $heroImage = $('.hero-image');

            /* Calculate percentComplete, which goes from 0 to 1 */
            var distanceScrolled = Math.max(0, $(window).scrollTop());
            var totalDistanceToScroll = $heroImage.height();
            var percentComplete = Math.min(distanceScrolled / totalDistanceToScroll, 1);

            /* Use percentComplete to determine how much we translate */
            var translateY = (percentComplete * 100 * FACTOR);

            /* Apply the transform */
            $heroImage.css({'transform': 'translateY(' + translateY + '%)'});

            /**********************
             * Pinning the navbar *
             **********************/

            var $navbar = $('nav');
            var $navbarWrapper = $('.navbar-wrapper')

            /* navbarWrapper never moves, so it's a good pinPoint */
            var pinPoint = $navbarWrapper.offset().top;

            /* add or remove the 'pinned' class depending on what side of the pin
             * point we are.
             */
            if (distanceScrolled >= pinPoint) {
                $navbar.addClass('pinned');
            } else {
                $navbar.removeClass('pinned')
            }
        });

        /*************
         * Scroll to *
         *************/

        $('a[href*="#"]').click(function(e) {
            e.preventDefault();
            var $target = $($(this).attr('href'));
            var scrollTop = $target.offset().top;
            $('html, body').animate({'scrollTop': scrollTop}, 500);
        });

    });
</script>

<style>
    .hero-image {
        top: 1rem;
        bottom: 2rem;
        left: 30rem;
        width: 50%;
        background-image: url(https://newmusicusa.org/wp-content/uploads/2012/10/musicians_top.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        position: absolute;
        z-index: 1;
    }

    .hero h1 {
        position: relative;
        text-align: center;
        color: black;
        padding-top: 1rem;
        z-index: 2;
    }

    .navbar-wrapper {
        height: 3rem;
    }
    nav.pinned {
        position: fixed;
        top: 0;
        background-color: #f5f5f5;
        transition: 0.2s ease background-color;
        -webkit-transition: 0.2s ease background-color;

    }

    /* Eric Meyer's Reset CSS v2.0 - http://cssreset.com */
    html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{border:0;font-size:100%;font:inherit;vertical-align:baseline;margin:0;padding:0}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}table{border-collapse:collapse;border-spacing:0}

    /* Default header styles */
    h1, h2, h3, h4, h5, h6 {
        font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
        font-weight: 300;
        color: #222222;
        line-height: 1.4; }
    h1 {
        font-size: 2.75rem; }
    h2 {
        font-size: 1.6875rem; }
    h3 {
        font-size: 1.375rem; }
    h4 {
        font-size: 1.125rem; }
    h5 {
        font-size: 1.125rem; }
    h6 {
        font-size: 1rem; }

    /* Base element styles */
    body, html {
        width: 100%;
        height: 50%;
        font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
        font-size: 16px;
        color: black; }

    a, a:hover {
        color: inherit;
        text-decoration: none; }

    ul {
        margin: 2rem 0;
        list-style: disc;
        padding-left: 2rem; }
    ul li {
        padding: 0.5rem 0; }

    p {
        margin: 1rem 0;
        line-height: 1.8; }

    .content {
        max-width: 60rem;
        margin: 0 auto;
        width: 100%; }

    .hero {
        position: relative;
        overflow: hidden;
        height: 30rem; }

    section { padding: 6rem 0 3rem; }

    footer {
        margin-top: 4rem;
        padding: 5rem;
        background-color: #222;
        color: white;
        text-align: center; }
    footer p {
        margin: 0;
        }

    /* Navbar Styles */

    nav {
        height: 3rem;
        position: relative;
        width: 100%; }
    nav ul {
        height: 3rem;
        margin: 0;
        padding: 0;
        display: inline-block;
        font-size: 0;
        list-style: none; }
    nav ul li {
        font-size: 1rem;
        padding: 0;
        display: inline-block;}
    nav ul li p {
        height: 1.5rem;
        line-height: 1.5rem;
        margin: 0;
        padding: 0.75rem 1.5rem; }
    nav ul li:hover {
        cursor: pointer;
        background-color: #eee; }
    nav ul li.action-item {
        color: black;
        background-color: white; }
    nav ul li.action-item:hover {
        color: black;
        background-color: #eee; }
    nav ul.right { float:right; }
</style>

<footer>
    <p><a href="#"> L1Sanya's </a></p>
</footer>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- User scripts -->
<script type="text/javascript" src="script.js"></script>
</body>
</html>
