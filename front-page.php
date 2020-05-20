<?php get_header(); ?>

<div  class="mainPage">

  <div id= "section1" class="section">
    <span class="zeroun">01</span>
    <div class="red"></div>
 
      <div alt="image1" class="img1"></div>
      <div alt="image2" class="img2"></div>
      <div alt="image3" class="img3"></div>
 
    <span class="photo">Photographies</span>
  </div>

  <div id="section2" class="sectionDeux">
    <span class="video">Vidéos</span>
    <div class="red2"></div>
    <iframe 
      class="img4" 
      src="https://www.youtube.com/embed/l9yCIbvD2S0" 
      frameborder="0" 
      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
      allowfullscreen>
    </iframe>
    <iframe 
      class="img5" 
      src="https://www.youtube.com/embed/cDHMobCK_-8" 
      frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
      allowfullscreen>
    </iframe>
    <iframe 
      class="img6" 
      src="https://www.youtube.com/embed/XLE10W3fFq4" 
      frameborder="0" 
      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
      allowfullscreen>
    </iframe>
    <span class="deux">02</span>
  </div>

  <div id= "section3" class="sectionTrois">
    <div alt="image7" class="img7"></div>
    <div alt="image8" class="img8"></div>
    <div alt="image9" class="img9"></div>
    <span class="trois">03</span>
    <div class="red3"></div>
    <span class="espace">Espace</span>
    
    <a id="retour" href="#masthead"><i class="fas fa-arrow-up"></i></a>
  </div>
  
  
  <!-- <aside class="col-md-4 blog-sidebar"> -->
  <?php /*get_sidebar('homepage');*/ ?>

  <?php /*if (get_field('jardin') === true):*/ ?>
  <!-- <p>Jardin :</p> <?php /* get_field('surface_jardin')*/ ?>m2 -->
  <?php /* endif */ ?>
  <!-- </aside> -->

</div>
<?php get_footer(); ?>