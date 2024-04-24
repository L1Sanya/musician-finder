<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accordion Menu With Icon</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
        /* Your CSS styles here */
        body{margin-top:50px;}
        /* Other styles... */
    </style>
</head>
<body>
<div class="container">
    <!-- Your content here -->
</div>
</body>
</html>
<style>
    body{margin-top:50px;}
    .accordion-menu .panel-body{padding:0; margin:0;}
    .accordion-menu .panel-heading{background-color:#FFFFFF;}
    .accordion-menu .panel-heading:hover{
        background:#f5f5f5;
    }

    .accordion-menu .panel{
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.05);}

    .glyphicon-icon-rpad .glyphicon,.glyphicon-icon-rpad .glyphicon.m8,.fa-icon-rpad .fa,.fa-icon-rpad .fa.m8{ padding-right:8px; }
    .glyphicon-icon-lpad .glyphicon,.glyphicon-icon-lpad .glyphicon.m8,.fa-icon-lpad .fa,.fa-icon-lpad .fa.m8{ padding-left:8px; }
    .glyphicon-icon-rpad .glyphicon.m5,.fa-icon-rpad .fa.m5{ padding-right:5px; }
    .glyphicon-icon-lpad .glyphicon.m5,.fa-icon-lpad .fa.m5{ padding-left:5px; }
    .glyphicon-icon-rpad .glyphicon.m12,.fa-icon-rpad .fa.m12{ padding-right:12px; }
    .glyphicon-icon-lpad .glyphicon.m12,.fa-icon-lpad .fa.m12{ padding-left:12px; }
    .glyphicon-icon-rpad .glyphicon.m15,.fa-icon-rpad .fa.m15{ padding-right:15px; }
    .glyphicon-icon-lpad .glyphicon.m15,.fa-icon-lpad .fa.m15{ padding-left:15px; }

    .accordion-menu h4{position:relative;}

    .accordion-menu h4 .accordion-menu-collapsible-icon{position:absolute; right:0; top:5px; font-size:9px; }
    .accordion-menu h4 a{display:block; color:#666666;}
    .accordion-menu h4 a.active,.accordion-menu h4 .active, .active{text-decoration:none;}
    .accordion-menu h4 a:hover,
    .accordion-menu h4 a:focus{text-decoration:none; color:#222222;}
    .accordion-menu h4 .accordion-menu-title-icon
    {
        float:right;
        margin:0;
    }
    .accordion-menu ul{list-style:none; padding:0
    ; margin:0;}
    .accordion-menu ul li .badge,.accordion-menu ul li span.badge,.accordion-menu ul li label.badge{float:right}
    .accordion-menu ul li:first-child a{}
    .accordion-menu ul li:last-child a{border:0
    solid #f9f9f9;}
    .accordion-menu ul li a{display:block; line-height:22px; padding:5px 15px; margin:0
    ; border-bottom:1px solid #e8e8e8;}
    .accordion-menu ul li a:hover{color:#232323;text-decoration:none;}
    .accordion-menu ul.bullets{list-style:inside disc}
    .accordion-menu ul.numerics{list-style:inside decimal}
    .accordion-menu ul.kas-icon{}
    .accordion-menu ul.kas-icon-aero li a:before{
        font-family: 'Glyphicons Halflings', serif; font-size:9px; content: "\e258"; padding-right:8px; }

</style>
