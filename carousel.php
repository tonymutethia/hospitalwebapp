<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Container -->
                <div id="header-container" style="text-align: center;" >
                    <P  style="color: rgb(24, 192, 136);"> </P>
                </div>
    
                <!-- Carousel Container -->
                <div id="carouselExampleIndicators" class="carousel slide" >
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
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
    </div>
  </body>
</html>>