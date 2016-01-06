
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
		<div class=' col-md-2 col-md-offset-1'>
			<ul class='nav'>
				<li><a href='http://twitter.com/jimmytidey'>Twitter</a></li>
				<li><a href='/blog'>Blog</a></li>
				<li><a href='http://github.com/jimmytidey'>GitHub</a></li>
				<li><a href='/phd/'>PhD study</a></li>    
			</ul>
		</div>

		<div class='col-md-7 '>
      
			<p>I'm a PhD candidate at Royal College of Art, with a background in web development and digital product management.</p>
      
      <p>I'm researching ways social media activity inform public policy.</p>
      
      <p>My research has led to the development of <a href=''>localnets.org</a> webapp, which facilitates policy consultation via Twitter.</p>
      
      <p>There have been two case studies using the software:<p> 

      <ul>
        <li>Hounslow (with NESTA and RSA)</li>
        <li>Peterborough (with UCLAN and RSA)</li>
        <li>A third with NHS Birmingham is upcoming</li>
      </ul>
			
			<p>My work is grounded conceptually in the idea that the problem of social coordination - matching needs with capabilities, coordinating how resources are created and shared in communities. Both markets and the public sector are attempts to address this problem.</p>
			
			<p>Can the huge quantities of data that societies are now generating (big data) be used to solve the problem of social coordination? In the long run: </p>
			<ul>
			  <li>Will digital information create a new kind of highly tailored local public policy? </li>
			  <li>Might it, in some circumstances, substitute for price information in market economies?</li>
			  <li>What new kinds of organisations and communities are possible?</li>
			  <li>Will democratic inclusion increase or decrease?</li>
			</ul>

		</div>
	</div>
</div>

<script> 
	$('body').scrollspy({ target: '.work_nav' });
</script>


<?php  include 'footer.php' ?>




w