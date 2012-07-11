<?


$article_id = urldecode($_GET['article_id']); 



if ($article_id == urldecode('Local+by+Social+-++Where+sexy+social+media+and+bashful+local+government+go+to+flirt')) { 
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://jimmytidey.co.uk/blog/local-by-social-where-sexy-social-media-and-bashful-local-government-go-to-flirt/');
}

else if ($article_id == urldecode('Wikipedia+Book+of+the+Dead')) { 
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://jimmytidey.co.uk/blog/wikipedia-book-of-the-dead/');
}

else if ($article_id == urldecode('Honey%2C+the+kids+have+attained+Gigantick+Dimensions')) {
    header("HTTP/1.0 410 Gone");
}

else if ($article_id == urldecode('TEDx+Manchester+and+its+Discontents')) {
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://jimmytidey.co.uk/blog/tedx-manchester-and-its-discontents/'); 
}

else if ($article_id == urldecode('Dr+Beard%3A+Or+how+I+learned+to+stop+worrying+and+love+the+badinage')) {
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://jimmytidey.co.uk/blog/dr-beard-or-how-i-learned-to-stop-worrying-and-love-the-badinage/');
 
}


else {
    header("HTTP/1.0 410 Gone"); 
}













?>