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
                    <li><a href='#bucket'>CX Screen Prototype</a></li>
                    <li><a href='#software'>Software</a></li>
                    <li><a href='#nesta'>Work with RSA on NESTA BTR research project</a></li>                    
                </ul>
            </nav>
        </div>
        
        <div class='col-md-8 '>

            <p>I'm doing a PhD at RCA <a href='http://thecreativeexchange.org/'>on the CX programme</a>.</p> 

            <p>I'm looking at how taking preexisting, published digital activity (Twitter, Forums, etc.) and improving its visibility (through public screens or print) can change community cohesion.</p>

            <center>     
                <p><strong>Highly filtered geographic social media updates → public displays / print</strong></p> 
            </center>

            
            <p>My focus is on geographic communities, where content comes from hyperlocal forums and blogs, location-specific Facebook pages and relevant Twitter accounts.</p> 


            <p><strong>Increasing inclusivity.</strong> The goal is to present this content to people who would not normally see it, for example as a print-on-demand flyer in a local cafe or a screen in a shop window.</p>

            <p><strong>Beyond geotagging.</strong> Rather than relying on geotagging to gather data, which misses much important content, only sources which are known to produce a high volume of relevant content are selected, and a process of human moderation is used. This process is discussed in the <a href='#software'>software section</a>.</p>

            <p><strong>Network models of communities.</strong> Using a network model of communities will be developed as a tool to harvest, process and represent content</p>

            <p>The processing of designing physical prototypes will be informed by a series of workshops which is currently underway.</p> 


            <h2 id='phase_1'>Phase 1 workshops</h2>

            <p>To gather some initial feedback on the concept two workshops were undertaken.</p>
            
            <p><strong>Kensington &amp; Chelsea Council staff cafe</strong></p>

            <p>We captured 8 stories about the borough from across Twitter, Facebook, blogs and forums every day.</p>

            <p>The results were printed out and staff were able to read them while they ate their lunch.</p>

            <p>Some of the lessons that came from the project: </p>
            <ul> 
                <li>Local authorities are hard to engage with, although K&amp;C turned out to be very helpful</li>
                <li>Connecting to the Internet is HARD on Rasbberry Pi for adhoc workshops</li>
                <li>Little Printer wasn't right for the project - its API is not for real-time printouts</li>
                <li>Recipts are too short to convey enough information</li>
            </ul>

            <div class='row'>
                <div class='col-md-5 col-md-offset-1'> 
                    <img src='img/little_printer.png' class='img_border' />
                </div>
                <div class='col-md-5'>
                    <img src='img/receipt.png' class='img_border' />
                </div>
            </div>
               
            
            <p><strong>FACT Gallery</strong></p>
            
            <p><em>Asking cinema goers in the FACT gallery to respond to printed stories from Twitter &amp; Facebook.</em></p>

            <p>This workshop was an opportunity to see public reaction to hyperlocal news stories. Participants were are asked to organise the fragments of social media into piles while "thinking out loud" about the process.</p>

            <img class="img_border" src="img/fact.png" alt="Workshop at FACT gallery">

            <p>The workshop surprised me in terms of how well people understood out-of-context tweets, and elicited feedback on how local businesses use social media. </p>
            
            <h2 id='phase_2'>Phase 2 - Modeling communities as networks </h2>

            <p><a href='https://twitter.com/johnfass'>@johnfass</a>'s technique asks participants to draw out their social networks using rubber bands and drawing pins. I intend to use an expanded version of this approach for the second phase of workshops.</p>

            <iframe src="//player.vimeo.com/video/100644300" class='vid' frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
            

            <h2 id='bucket'>CX screen prototype</h2>

            <p>In the Newcastle and London CX offices we have a screens using the <a href='#software'>Observatory software</a> displaying tweets from across the CX hub</p>

            <p>This has been an opportunity to address basic problems, such as turning the screen on and off automatically out-of-hours, and remotely updating software</p>

            <img class="img_border" src="img/bucket.jpg" alt="Bucket installed in CX office">

            <h2 id='software'>Software</h2>

            <p><strong>Observatory</strong></p>

            <img class="img_border width_control" src="img/obs.png" alt="Observatory software">
            <p>The Observatory software is written on the <a href='http://meteor.com'>Meteor platform</a>, and provides a mechanism to gather and classify content from:</p>

            <ul>
                <li>Facebook</li>
                <li>Twitter</li>
                <li>Vimeo</li>
                <li>Tumblr</li>
                <li>RSS / Blogs</li>
            </ul>

            <p>It allows content to be assigned to 'community nodes', so that network of the underlying community interactions becomes apparent.</p>  

            <p>The code is available <a href='http://github.com/jimmytidey/obs'>here</a>.</p>

            <p><strong>Wonkbook</strong></p>
            <img src="img/wonkbook.png" class='img_border'  alt="Wonkbook screen shot">
            <p>Wonkbook was an experiment with Stian Westlake from NESTA. The project started by scraping think tank websites and populating a database of reports and staff </p>
            <p>From there we became interested in finding the Twitter feeds of think tank staff, which gave us a real-time window into the ecosystem.</p>
            <p>We combined this Twitter data with the Twitter feeds of MPs and Journalists to create a league table of a the most retweeted individuals and think tanks.</p>

            <p>The code is available <a href='https://github.com/jimmytidey/think_tank_bank'>here</a>.</p>

            <h2 id='nesta'>Partnering with RSA on NESTA 'below the radar' project</h2>

            <p>With the RSA and <a href='https://twitter.com/marksimpkins'>@marksimpkins</a> I'm working on a NESTA grant for <a href='http://www.nesta.org.uk/data-driven-methods-mapping-below-radar-activity-social-economy'>"Data Driven Methods for Mapping 'Below the Radar' Activity in the 'Social Economy'"</a>.</p>

            <p>The project will look at the borough of Hounslow, where the RSA are conducting an on the ground survey of community assets. This will be compared to what can be gathered digitally through a system derived from the Observatory software.</p>

            <p>Digital asset mapping will proceed in two steps. The first will take a hand picked collection of nodes (Twitter, Facebook, and Blogs). We will the use a spidering algorithm to increase the number of nodes on the network.</p>

            <p>The goal of the project is to see if processing social media can help asset mapping - a process which many local authorities find time consuming and expensive. In particular, the goal is to help keep these lists up to date, by providing updates between on the ground surveys.</p>

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




