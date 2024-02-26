<?php
    include("header.php");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HewaHosp</title>
    <link rel="icon" href="icon/icon1.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.bundle.js"></script>
 <script src="js/script.js"></script>

<link rel="stylesheet" href="css/styles.css">
</head>
   
   <body style="background-color: antiquewhite;">
    <div  style="text-align: center;" >
        <P  style="color: rgb(24, 192, 136);"> </P>
    </div>
    
   
    <!--carousel begins here -->
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-12">
                <!-- Header Container -->
                
    
                <!-- Carousel Container -->
                <div id="carouselExampleIndicators" class="carousel slide" >
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"> </button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
    
                    <!-- Carousel Inner Container -->
                    <div class="carousel-inner">    
                        <!-- Carousel Item 1 -->
                        <div class="carousel-item active">
                            <img src="pic/pexels5.jpeg" class="d-block w-100 c-img c-img1" alt="...">
                            <div class="carousel-caption">
                                <h4 style="color:rgb(214, 229, 0)">Hewa Hospital, Nairobi</h4>
                                <p style="color:rgb(31, 220, 2)">Hewa Hospital is located in Nairobi and provides high-quality healthcare services to the community.</p>
                              </div>
                        </div>
    
                        <!-- Carousel Item 2 -->
                        <div class="carousel-item">
                            <img src="pic/pexels6.webp" class="d-block w-100 c-img" alt="...">
                        </div>
    
                        <!-- Carousel Item 3 -->
                        <div class="carousel-item">
                            <img src="pic/emergencypic.webp" class="d-block w-100 c-img" alt="...">
                        </div>
                    </div>
    
                    <!-- Carousel Control Buttons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div><!-- Carousel Container (end) -->
            </div><!-- Column 1 (end) -->
        </div><!-- Row (end) -->
    </div><!-- Container (end) -->
    <main class="my-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-2">
                    <img src="pic/pexels2.webp" alt="Image 1" class="circle img-fluid img1">
                    <h4 style="background-color: aquamarine;">we have the best designs of the hospital in Africa</h4>
                </div>
                <div class="col-md-4 col-sm-6 mb-2">
                    <img src="pic/pexels3.jpeg" alt="Image 2" class=" img-circle img-fluid img1">
                    <h4 style="background-color: aquamarine;">we have the best designs of the hospital in Africa</h4>
                </div>
                <div class="col-md-4 mb-2">
                    <img src="pic/pexel1.webp" alt="Image 3" class=" img-thumbnail img-fluid img1">
                    <h4 style="background-color: aquamarine;">we have the best designs of the hospital in Africa</h4>
                </div>
            </div>
        </div>
    </main>
    
        
    <main class="my-4 mx-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h1 style="color: rgb(222, 17, 17);">HEWA THE BEST GUARDIAN HOSPITAL</h1>
                    <p>
                        Hello! At our hospital, we are committed to delivering exceptional healthcare with compassion,
                        <a class="btn-sm btn btn-info" href="readmore1.html">
                            Read More
                        </a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h1 style="color: rgb(109, 230, 23);">HEWA THE BEST GUARDIAN HOSPITAL</h1>
                    <p>
                        Hello! At our hospital, we are committed to delivering exceptional healthcare with compassion,
                        <a class="btn btn-sm btn btn-success" href="readmore2.html">
                            Read More
                        </a>
                    </p>
                    
                </div>
                <div class="col-md-4">
                    <h1 style="color: rgb(253, 0, 118);">HEWA THE BEST GUARDIAN HOSPITAL</h1>
                    <p>
                        Hello! At our hospital, we are committed to delivering exceptional healthcare with compassion,
                        <a class="btn btn-sm btn btn-danger" href="readmore3.html">
                            Read More
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>   
</body>
   
</html>

<?php
    include("footer.php");
?>