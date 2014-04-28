
<?php 
$title = 'Jimmy Tidey';
include('header.php');
?>

<div class='container'>
	<div class='row'>
		<div id='background' class='col-md-7 col-md-offset-3'>
			<h1>Jimmy Tidey</h1>
		</div>
	</div>

	<div class='row'>
		<div class='navbar col-md-2 col-md-offset-1'>
			<ul class='nav'>
				<li><a href='http://twitter.com/jimmytidey'>Twitter</a></li>
				<li><a href='/blog'>Blog</a></li>
				<li><a href='http://github.com/jimmytidey'>GitHub</a></li>
				<li><a href='/phd/'>PhD study</a></li>    
			</ul>
		</div>

		<div class='col-md-7 '>

			<p>I'm a web developer and researcher. I use my tech skills to rapidly prototype social interventions.</p>

			<p>I'm a PhD candidate at the <a href='http://www.thecreativexchange.org/'>Royal College of Art CX Hub</a>. My interests are: </p>
			
			<ul>
				<li>Using social media as <a href='phd/overview'>community glue</a> (the subject of my PhD)</li>
				<li>Interfaces <a href='/phd/overview/#work_so_far'>beyond</a> the screen and keyboard</li>
				<li><a href='http://bike-calculator.jimmytidey.co.uk/'>Little web apps</a> &amp; html essays as an explanatory medium</li>
			</ul>

			<h2>Recent Work</h2>
			<ul class='work_nav'>
				<li><a href='#social_mirror'>Social Mirror with RSA</a></li>
				<li><a href='#community_mirror'>Community Mirror with NESTA / RSA</a></li>	
				<li><a href='#podaris'>Podaris, transport infrastructure planning</a></li>
				<li><a href='#wonkbook'>WonkBook, Twitter league table for think tanks</a></li>
				<li><a href='#lambeth'>Mapping module for Lambeth Council website</a></li>
			</ul>

			<h2>Example Personal Projects</h2>
			<ul class='work_nav'>
				<li><a href='#heresay'>Heresay</a></li>
				<li><a href='#last_fm'>Last FM</a></li>
				<li><a href='#book_of_dead'>Michael Jackson is more important than Jesus</a></li>
				<li><a href='#bike_calculator'>Bike Calculator</a></li>
			</ul>



			<h3 id='social_mirror'>Social Mirror</h3>
			<p>Social Mirror is a system to deliver social prescriptions to vulnerable people. Participants fill out a survey about their social life, and it suggests community groups they could join, or activities that might broaden their social network.</p>
			
			<p>My involvement with the project is as Node.js developer.</p>

			<p><a href='http://www.thersa.org/action-research-centre/community-and-public-services/connected-communities/social-mirror'>Website</a> </p>
			

			<h3 id='community_mirror'>Community Mirror</h3>
			<p>Community Mirror is a response to the <a href='http://www.nesta.org.uk/data-driven-methods-mapping-below-radar-activity-social-economy'>NESTA call</a> for research into 'below the radar activity in the social economy'.  </p>
			<p>We will be comparing real-world data about community assets, gathered by a door to door survey, with data gathered algorithmically online using the <a href='#heresay'>Heresay</a> platform.</p>


			<h3 id='podaris'>Podaris</h3>
			<p>Podaris is a tool for designing urban transport networks collaboratively. I helped migrate their mapping tool to the Meteor Javascript framework.</p>
			<p><a href='www.podaris.com'>Website</a></p>
			
			<h3 id='wonkbook'>WonkBook</h3>
			<p>Wonkbook is a project with <a href='http://www.nesta.org.uk/users/stian-westlake'>Stian Westlake</a> at NESTA. It collects twitter interactions from MPs, Think Tank staff and journalists. Using this data it constructs league tables.	</p>
			
			<p><a href='http://wonkbook.io/'>Website</a></p>


			<h3 id='lambeth'>Lambeth</h3>
			<p>I worked with Lambeth Council work on their "cooperative council" community driven website. My work was mainly focused on mapping and open data, and led to <a href='https://github.com/jimmytidey/community_maps'>open repository</a> of the drupal module we bulit.</p>  

			<p><a href='http://www.lambeth.gov.uk/rubbish-and-recycling/recycling/map-of-recycling-centres'>Example</a></p>	

			<hr />

			<h3 id='heresay'>Heresay</h3>
			<p>Heresay scans blogs, forums, Facebook and Twitter for hyperlocal information. It tags and geolocates this data.</p>

			<p>The data it produces is useful for a variety of projects and as part of my PhD.</p>

			<p><a href='http://heresay.org.uk'>Website</a></p>

			<h3 id='last_fm'>Last FM</h3>
			<p>What does Last FM behavior say about musical taste? Can you draw a family tree of musical genre using it?</p>
			<p>This project was an opportunity to experiment with finding empirical evidence in the face of something as subjective as musical taste.</p>  
			<p><a href='http://jimmytidey.co.uk/blog/lost-in-the-noise-what-we-really-think-about-musical-genres/'>More here</a></p>


			<h3 id='book_of_dead'>Michael Jackson is more import than Jesus</h3>
			<p>I wanted to play with semantic data on Wikipedia - using it to get bulk data about influential dead people. I also wanted to explore the idea of Wikipedia as a canonical structuring of knowlege.</p>
			<p><a href='http://jimmytidey.co.uk/blog/michael-jackson-is-more-important-than-jesus-fact/'>More here</a></p>

			<h3 id='bike_calulator'>Bike Calculator</h3>
			<p>Saw a thing on Kick Starter, doubted it could exist, built a calculator, discovered it probably could.</p>
			<p><a href='http://bike-calculator.jimmytidey.co.uk'>Website</a></p>
		</div>
	</div>
</div>

<script> 
	$('body').scrollspy({ target: '.work_nav' });
</script>


<?php  include 'footer.php' ?>




