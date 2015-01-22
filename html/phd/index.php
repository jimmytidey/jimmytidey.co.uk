<?php 
$title = 'PhD Overview';
include('../header.php');
?>

<div class='container'>
    <div class='row'>
        <div id='background' class='col-md-8 col-md-offset-3'>
            <h1  id='intro'>Making digital community activity visible</h1>
        </div>
    </div>
    
    <div class='row'>
        <div class='col-md-3  '>
            <nav id="affix-nav" >
                <ul class="nav" data-spy="affix" data-offset-top="10">
                    <li><a href='#intro'>Intro</a></li>
                    <li><a href='#phase_1'>Phase 1 workshops - RBKC council</a></li>
                    <li><a href='#phase_2'>Phase 2 workshops - Modeling the Hounslow network</a></li>
                    <li><a href='#bucket'>CX Screen Prototype</a></li>
                    <li><a href='#software'>LocalNets</a></li>
                    <li><a href='#nesta'>Work with RSA on NESTA BTR research project</a></li>                    
                </ul>
            </nav>
        </div>
        
        <div class='col-md-8 '>

            <p>I'm doing a PhD at RCA <a href='http://thecreativeexchange.org/'>on the CX program</a>.</p> 

            <p>I'm looking at how the structure of a community is reflected in social media activity. I have <a href='#software'>built a web app</a> to enable this.</p>

            <p>My focus is on geographic communities, looking at hyperlocal forums,  blogs, location-specific Facebook pages and locally-oriented Twitter accounts.</p> 

            <p>Using this data, my work attempts to generate a list of community assets, and a network representation of the way assets people interact.<p>            

            <p>This information is valuable to two groups:<p>

            <ul>
                <li>The community itself, where it can be used to increase awareness of community assets, and to act collectively to protextx and improve those assets.</li>
                <li>Charities and local and national government, who may want to promote policies aimed at local communities, or to support community assets.</li>
            </ul>



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
            
            

            <h2 id='phase_2'>Phase 2 workshops - Modeling communities as networks </h2>

            <p><a href='https://twitter.com/johnfass'>@johnfass</a>'s technique asks participants to draw out their social networks using rubber bands and drawing pins. I intend to use an expanded version of this approach for the second phase of workshops.</p>

            <iframe src="//player.vimeo.com/video/100644300" class='vid' frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
            
            <p>When asking a community member to engage in the network mapping process, I'd like to include prompts derived from the data I have gathered from social media.</p>

            <p>For example, pre-populating the board with the community nodes I have discovered through social media analysis, or highlighting important geographic locations, while still allowing the participant to fluidly 'think-out-loud' about what they are doing.</p> 

            <p>This may take the form of a printed, or 3D printed layer for users to stick pins in, or be even more divergent from the current model.</p> 

            <h2 id='bucket'>CX screen prototype</h2>

            <p>In the Newcastle and London CX offices we have a screens using the <a href='#software'>Observatory software</a> displaying tweets from across the CX hub</p>

            <p>This has been an opportunity to address basic problems, such as turning the screen on and off automatically out-of-hours, and remotely updating software</p>

            <img class="img_border" src="img/bucket.jpg" alt="Bucket installed in CX office">

            <h2 id='software'>LocalNets</h2>

            <img class="img_border width_control" src="img/obs.png" alt="Observatory software">
            <p><em>Dashboard</em></p> 

            <p>LocalNets is a software tool to map and explore online conversations about community issues.<p>

            <p>It can be accessed at <a href='http://localnets.org'>localnets.org</a>, though it's very much a prototype.<p>                

            <p>It provides a mechanism to gather and classify content from:</p>

            <ul>
                <li>Facebook</li>
                <li>Twitter</li>
                <li>Vimeo</li>
                <li>Tumblr</li>
                <li>RSS / Blogs</li>
            </ul>

            <p>The software is 'seeded' with Twitter accounts, blogs or forums that focus on local issues, say within a particular town or borough. From there it automatically discovers new community-oriented content.</p> 

            <p>The Observatory automatically adds metadata such as topic tags and location. It also attempts to identify 'community nodes', which could be locations, facilities, people or organisations.</p>
   
            <img class="img_border width_control" src="img/peterborough_heatmap.png" alt="Hounslow Network Diagram ">
            <p><em>Heatmap of Hyperlocal activity in Peterborough</em></p> 

            <br/>

            <img class="img_border width_control" src="img/hounslow_network.png" alt="Hounslow Network Diagram ">
            <p><em>Network map of Hounslow generated with Hyperlocal Observatory</em></p> 

            <p>The goal of the software is to allow any party with a stake in a community to better understand what is going on. It is analogous and complimentary to traditional on-the-ground community surveying methods.</p>

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




