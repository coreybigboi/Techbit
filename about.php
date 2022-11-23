<!DOCTYPE html>
<html>
  <head>
    <title>About</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php
      session_start();
      require "menu.php";
    ?>
    <br />
    <div class="container">
      <h1 class="pageTitle">About</h1>
      <div class="aboutSection">
        <h3>Challenges for making this blog website</h3>
        <p>The biggest challenge of making this website was bringing everything I've learned together in a single web app. This was my first experience using html, css, javascript, and php. Overall, I'm very proud of what I've accomplished.</p>
      </div>
      <div class="aboutSection">
        <h3>Website Features</h3>
        <ul>
            <li>Register an account and log in.</li>
            <li>Create posts and rate other people's posts.</li>
            <li>Dynamic menu based on whether user is logged in.</li>
            <li>Can only create posts if logged in.</li>
            <li>Home page displays 4 most recent posts, overflow is stored on the archive page.</li>
        </ul>
      </div>
      <div class="aboutSection">
        <h3>References</h3>
        <ul>
          <li>Background image: Stephen Gheysens, 2017, Toptal, accessed 22/03/2022, 	https://www.toptal.com/designers/subtlepatterns/gaming/</li>
          <li>Banner Image: HQvectors, 2013, Toptal, accessed 25/03/2022, https://www.toptal.com/designers/subtlepatterns/notebook/</li>
          <li>Box Shadow: W3 Schools, 2022, W3 Schools, accessed 24/03/2022, https://www.w3schools.com/cssref/css3_pr_box-shadow.asp</li>
          <li>Drop Down Menu: Stackoverflow, 2021, Stackoverflow, accessed 24/03/2022, https://stackoverflow.com/questions/24582056/html-select-menu-as-navigation-menu</li>
          <li>Font: Reekee of Dimenzioned, 2022, dafont, accessed 24/03/2022, https://www.dafont.com/arcadepix.font</li>
          <li>Guide for submitting button names in a form: Learning about Electronics, 2018 "How to Check if the Submit Button Is Clicked in PHP" Learning about Electronics, accessed 10/05/2022, http://www.learningaboutelectronics.com/Articles/How-to-check-if-the-submit-button-is-clicked-in-PHP.php</li> 
          <li>UTAS KIT202 unit material</li>
        </ul>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
