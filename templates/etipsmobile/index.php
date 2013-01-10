<?php





defined('_JEXEC') or die;







JHTML::_('behavior.framework', true);







/* The following line gets the application object for things like displaying the site name */



$app = JFactory::getApplication();



$tplparams  = $app->getTemplate(true)->params;







$social_media = htmlspecialchars($tplparams->get('social_media'));



$social_media_title = htmlspecialchars($tplparams->get('social_media_title'));



$facebook = htmlspecialchars($tplparams->get('facebook'));



$twitter = htmlspecialchars($tplparams->get('twitter'));



$myspace = htmlspecialchars($tplparams->get('myspace'));



$linkedin = htmlspecialchars($tplparams->get('linkedin'));



$youtube = htmlspecialchars($tplparams->get('youtube'));



$vimeo = htmlspecialchars($tplparams->get('vimeo'));



$flickr = htmlspecialchars($tplparams->get('flickr'));



$digg = htmlspecialchars($tplparams->get('digg'));



$skype = htmlspecialchars($tplparams->get('skype'));



$amazon = htmlspecialchars($tplparams->get('amazon'));



$appstore = htmlspecialchars($tplparams->get('app-store'));



$delicious = htmlspecialchars($tplparams->get('delicious'));



$deviantart = htmlspecialchars($tplparams->get('deviant-art'));



$ebay = htmlspecialchars($tplparams->get('ebay'));



$icq = htmlspecialchars($tplparams->get('icq'));







?>



<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">



<head>



  <!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->



  <jdoc:include type="head" />




  <link  href="//fonts.googleapis.com/css?family=Calligraffitti:regular" rel="stylesheet" type="text/css" >



  



  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" />



  <!-- The following line loads the template CSS file located in the template folder. -->



  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css?v2" type="text/css" />



  <!-- The following line loads the template JavaScript file located in the template folder. It's blank by default. -->



  <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/CreateHTML5Elements.js"></script>



<!--

  <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/template.js"></script>

-->    

   

  <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.4.4.min.js"></script>



  <script type="text/javascript">jQuery.noConflict();</script>



    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/select.js"></script>





  <?php
  $document =& JFactory::getDocument();
  $document->addCustomTag('<meta property="og:image" content="'. JURI::base() . 'images/etips_200.jpg"/>');

  $twitter_name = htmlspecialchars($tplparams->get('twitter_name'));



  if ( $twitter_name && $twitter_name!='' ) : ?>



    <script type="text/javascript">



      jQuery(function(){



        var twitter_username = '<?php echo $twitter_name?>'; 



        jQuery.ajax({



            url: 'http://api.twitter.com/1/users/show.json',



            data: {screen_name: twitter_username},



            dataType: 'jsonp',



            success: function(data) {



                jQuery('.followers').html(data.followers_count);



            }



        });



      });



    </script>



  <?php endif; ?>

  <!-- google analytics END -->
  <!-- Put the following javascript before the closing </head> tag. -->
    <script>
      (function() {
        var cx = '017525967829683181080:_lczuqpjctw';
        var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
        gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
            '//www.google.com.ar/cse/cse.js?cx=' + cx;
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
      })();
    </script>

  <!-- google analytics START -->
  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11624374-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  </script>

</head>



<body class="page_bg">







<div class="page">



  <div class="wrapper">

    <div class="logo">
        <a href="/"><jdoc:include type="modules" name="logo" /></a>
        <div class="top_links">
            <jdoc:include type="modules" name="top_links" />
        </div>
    </div>
    
        <style>

    .noover {

      display:none;}

    .noover a:link, .noover a:hover {

      color:#0088CC;}

      .siover a:link, .siover a:hover {

      color:#0088CC;}

    .siover {

      display:block;}

        </style>

        <div id="lang"  onMouseOver="change_lang_()" onMouseOut="change_lang_out_()">

        

          <jdoc:include type="modules" name="lang" />

        

        

        </div>

        

        <div id="search" style="margin-top:37px;">
            <jdoc:include type="modules" name="search" />
            <link rel="stylesheet" href="//www.google.com/cse/style/look/default.css" type="text/css" /> <style type="text/css">
              input.gsc-input {
                border-color: #E5E5E5 #DBDBDB #D2D2D2;
                background:url("../images/lang.jpg") repeat scroll 0 0 white;
              }
              input.gsc-search-button {
                border-color: #E5E5E5 #DBDBDB #D2D2D2;
                background-color: #CECECE;
              }
            </style>
            <gcse:searchbox-only></gcse:searchbox-only>
        </div>



    <div class="top" align="center">



      <div id="home_" style="width:100px; float:left; position:absolute; z-index:1000; height:28px; padding-top:11px; background:url('<?php echo $this->baseurl ?>/images/separator.png') no-repeat scroll right top transparent">

              <a href="/"><img src="<?php echo $this->baseurl ?>/images/icon.png" /></a>  

            </div>

      <jdoc:include type="modules" name="menu" />

            

            <script>

      totalwidth = 886/jQuery("ul.menu > li").size(); 

      jQuery('ul.menu > li').css('width',totalwidth  + 'px');
	  
	  jQuery('.gsc-input input').css('background','url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/lang.jpg) repeat scroll 0 0 white');



      /*jQuery('ul.menu > li').each(function(){

        jQuery(this).css('width',String(Math.floor(jQuery(this).width()/totalwidth))+'%');

      });

      

      jQuery('ul.menu').css('width','100%');*/



      </script>



    </div>



    <div class="main">



      <?php if( $this->countModules('position-7') and ($this->countModules('position-4') || $social_media) ) : ?>



      <div class="maincol">         



      <?php elseif( $this->countModules('position-7') and !$this->countModules('position-4') and !$social_media) : ?>



      <div class="maincol_left">



      <?php elseif( !$this->countModules('position-7') and ($this->countModules('position-4') || $social_media)) : ?>



      <div class="maincol_right">



      <?php else: ?>



      <div class="maincolumn_full">



      <?php endif; 

      

      $menu = JSite::getMenu();

      ?>

      



          <jdoc:include type="message" />

        



        <div class="cont">



          

                    <div>

                    

                      <jdoc:include type="modules" name="image-header" style="rounded"/>

                    

                    </div>

                    

                     

                    

                    <?php

          

          if ($menu->getActive() == $menu->getDefault( 'en-GB' )) {

            //echo 'This is the front page';

          }

          elseif ($menu->getActive() == $menu->getDefault( 'es-ES' )) {

            //echo 'Accueil';

          }

          else

          {

            ?>

                         <div class="cont_content">

                        

                        <?php 
						if(isset($_GET['buscar']))
						{
							?>
                            
                           
      
                            
                            <?php
							
							}
						
						?>

                         <jdoc:include type="component" />

                         <?php 

             if($this->countModules('archivo'))

             {

             ?>

                         <style>

             .item-page {

                   float: left;

                 width: 700px;}

             .blog {

               float: left;

                 width: 700px;

               }
               
             </style>

                        <div id="archivo_lateral" style="width:200px; float:left;">
                            <jdoc:include type="modules" name="archivo" style="rounded"/>
                        </div>
                        <div class="clr"></div>
                        <div style="margin-left: 30%;">
                            <jdoc:include type="modules" name="component_footer" style="rounded"/>
                        </div>
                        <?php 
             }?>

                        

                          </div>

            <?php

            }

          ?>

                           

                        <div <?php if ($menu->getActive() == $menu->getDefault( 'en-GB' ) || $menu->getActive() == $menu->getDefault( 'es-ES' )) {

          }

          else { echo 'style=" margin-top: 14px; float:left;"';

          }?>>

                    

                      <jdoc:include type="modules" name="news" style="rounded"/>

                    

                    </div>   

                    

                    



        </div>

                

                

                <div style="    float: left;    margin-top: 15px;    width: 997px;">

                

                  <div id="div_module_1">

                      <jdoc:include type="modules" name="module_1" style="rounded"/>

                    </div>

                    <div id="div_module_2">

                      <jdoc:include type="modules" name="module_2" style="rounded"/>

                    </div>

                    <div id="div_module_3">

                      <jdoc:include type="modules" name="module_3" style="rounded"/>

                    </div>

                    <div id="div_module_4">

                      <jdoc:include type="modules" name="module_4" style="rounded"/>

                    </div>

                

                </div>

                <div id="social_buttons" style="float:left; margin-left: 200px; margin-right:auto; margin-top: 18px; text-align: center; width: auto;">
                    <!--<a href="https://www.facebook.com/pages/ETIPS-MOBILE/111500398950144" title="Facebook" target="_blank"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/facebook.png" style="float:left; margin-top:5px; margin-right:20px;"/></a>-->
                    <!--<a href="https://twitter.com/#!/ETipsMobile" title="Facebook" target="_blank"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/twitter_.jpg" style="float:left; margin-top:6px; margin-right:20px;"/></a>-->
                    <jdoc:include type="modules" name="social" style="rounded"/>
                    <a href="http://www.youtube.com/watch?v=y6A1VQDOxSE&feature=player_embedded" title="Youtube" target="_blank"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/youtube.jpg" style="float:left"/></a>
                </div>
                <jdoc:include type="modules" name="bottom-menu" style="rounded"/>
      </div>







      <?php if( $this->countModules('position-4') || $social_media ) : ?>



      <div class="rightcol">



        <jdoc:include type="modules" name="position-4" style="rounded"/>



        

      



      </div>



      <?php endif; ?>



    



      <div class="clr"></div>



  <div class="footer">



    <?php $sg = ''; include "templates.php"; ?>



  </div>



    </div>



  </div>

    





</div>



</body>



<script>

//jQuery(".mod-languages form .inputbox").selectBox();  



//jQuery('.mod-languages form .inputbox').selectbox();

jQuery(document).ready(function($) {
    $("img:not([title])").each(function() {
            if($(this).attr("alt") != '') $(this).parent().attr("title", $(this).attr("alt"))
            else $(this).parent().attr("title", $(this).attr("src"));
    });
});

</script>

<?php 

        //phpinfo();

/*echo " <pre>";

            var_dump($lang__);

            echo "</pre>";*/

?>

</html>
