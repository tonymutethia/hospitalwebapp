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
   
    <body>
        <div>
            <div class="container-fluid my-4">
                <div class="row" style="height:auto;" >
                <div class="col" style="background-color: red;">
                    <?php
                    include("sidebar.php");
                    ?>
                </div>
                    <div class="col mb-2" style="background-color: rgb(193, 220, 196);" >
        <style>

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

        </style>
    <h3>Contact Form</h3>

        <div class="container">
        <form action="/action_page.php">
            <label for="fname">Full Name</label>
            <input required type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="email">Enter Email</label>
            <input required type="text" id="email" name="email" placeholder="Your email address..">

            <label for="contact">Enter Contact Number</label>
            <input required type="tel" class="form-control" id="contact" placeholder="phone number.."><br>


            <label for="country">Country</label>
            <select id="country" name="country">
            <option value="australia">kenya</option>
            <option value="canada">Canada</option>
            <option value="usa">USA</option>
            </select>

            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

            <div class="text-center">
            <button type="submit" class="btn btn-primary w-25">Submit</button>
            </div>
            

        </form>
       
        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <div id="footer-container"></div>
</html>
<?php
        include("footer.php");
?> 