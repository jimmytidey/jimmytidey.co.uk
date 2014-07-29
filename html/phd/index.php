<?php 
$title = 'PhD Overview';
include('../header.php');
?>

<div class='container'>
    <div class='row'>
        <div id='background' class='col-md-8 col-md-offset-3'>
            <h1  id='intro'>Making digital social activity visible</h1>
        </div>
    </div>
    
    <div class='row'>
        <div class='col-md-3  '>
            <nav id="affix-nav" >
                <ul class="nav" data-spy="affix" data-offset-top="10">
                    <li><a href='#intro'>Intro</a></li>
                    <li><a href='#phase_1'>Phase 1 workshops</a></li>
                    <li><a href='#phase_2'>Phase 2 workshops - Modeling communities as networks</a></li>
                    <li><a href='#physical_prototypes'>Physical Prototypes</a></li>
                    <li><a href='#software'>Software</a></li>
                    <li><a href='#nesta'>Work with RSA on NESTA BTR research project</a></li>                    
                </ul>
            </nav>
        </div>
        
        <div class='col-md-8 '>

            <p>I'm doing a <a href='http://thecreativeexchange.org/'>PhD at RCA</a>. 

            <p>I'm looking at whether taking preexisting, published digital activity (Twitter, Forums, etc.) and improving its visibility (through public screens or print) can increase community cohesion.</p>
            
            <p>My focus is on geographic communities, where content comes from hyperlocal forums and blogs, location-specific Facebook pages and relevant Twitter accounts.</p> 

            <p>The goal is to present this content to people who would not normally see it, for example as a print on-demand flyer in a local cafe or a screen in a shop window.</p>

            <p>The intervention will be informed by a programme of workshopping which is currently underway.</p> 


            <h2 id='phase_1'>Phase 1 workshops</h2>

            <p>To gather some initial feedback on the concept two workshops were undertaken.</p>
            
            <p><strong>Kensington &amp; Chelsea Council staff cafe</strong></p>

            <p>We captured 8 stories about the borough from across Twitter, Facebook, blogs and forums every day.</p>

            <p>The results were printed out and staff were able to read them while they ate their lunch.</p>

            <p>This project relied on the Heresay platform to find the data.</p>
            

            <div class='row'>
                <div class='col-md-5 col-md-offset-1'> 
                    <img src='img/little_printer.png' class='img_border' />
                </div>
                <div class='col-md-5'>
                    <img src='img/receipt.png' class='img_border' />
                </div>
            </div>
               
            
            <p><strong>FACT Gallery</strong></p>
            
            <p>Asking cinema goers in the FACT gallery to respond to printed stories from Twitter &amp; Facebook.</p>

            <p>This workshop was an opportunity to see public reaction to hyperlocal news stories. Participants were are asked to organise the fragments of social media into piles while "thinking out loud" about the process.</p>

            <img class="img_border" src="img/fact.png" alt="Workshop at FACT gallery">

            
            <h2 id='phase_2'>Phase 2 - Modeling communities as networks </h2>

            <p><a href='https://twitter.com/johnfass'>@johnfass</a>'s technique asks participants to draw out their social networks using rubber bands and drawing pins. I intend to use an expanded version of this technique for the second phase of workshops.</p>

            <iframe src="//player.vimeo.com/video/100644300" class='vid' frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
            

            <h2 id='physical_prototypes'>Physical prototypes</h2>

            <p></p>

            <h2 id='software'>Software</h2>

            <p></p>

            <h2 id='nesta'>Nesta</h2>

            <p></p>

        </div>
    </div>

    <!--
    <script>
    $('body').scrollspy({ target: '.navbar' });
    </script>
    -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            setTimeout(updateScrollSpy, 1000);
        });
        function updateScrollSpy() {
            jQuery('[data-spy="scroll"]').each(function () {
              var $spy = jQuery(this).scrollspy('refresh')
          });
        }
    </script>

</div>

<?php  include '../footer.php' ?>




