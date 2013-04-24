<? 



include 'phpQuery.php';

$query = urlencode($_GET['query']);
if(isset($_GET['callback'])) {
    $callback = $_GET['callback'];
}

    
    $target = "http://www.indeed.co.uk/" . $query ."-jobs";
    
    $selector = '.row';
    $results = dom_query($target, $selector);
    $jobs = array();
    foreach($results as $result) { 
        $tmp = array();
        $dirty = dom_query($result['node'], '.jobtitle');
        $tmp['title'] = trim($dirty['text']); 
        
        $dirty = dom_query($result['node'], '.summary');
        $tmp['description'] = trim($dirty['text']);
        
        $dirty = dom_query($result['node'], '.jobtitle');
        $tmp['link'] = trim($dirty['href']);
        
        
        $jobs[] =$tmp;
    }


    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: text/json');
    header('Content-type: application/json');
    $json = json_encode($jobs);


    if(isset($callback)) { 
        echo $callback . '('.$json.')';
    }
    else {
       echo($json);
    }

    function dom_query($target, $selector) { 
       
        //This function will process either Dom Nodes or URLs        
        if(@get_class($target) == "DOMElement") {
             $results = pq($selector, $target);
        } 

        else { 
            $dom = phpQuery::newDocumentFile($target);
            $results = pq($selector);
        }

       
        @$number_of_nodes = count($results);
       
        if ($number_of_nodes > 1) { //if we have many results convert from the Zend_Dom_Query_Result class to Dom Nodes
            
            $output_array = array();
            
            foreach ($results as $result) { 
                $temp_array['text'] = $result->textContent;
                $temp_array['href'] = $result->getAttribute('href');
                $temp_array['src'] = $result->getAttribute('src');
                $temp_array['node'] = $result;
                $output_array[] = $temp_array;
            }     
            $output = $output_array; 
        }
        
        else if ($number_of_nodes == 1){ // else, get the text out of this node
            foreach ($results as $result) { 
                $output['text'] = $result->textContent;  
                $output['href'] = $result->getAttribute('href'); 
                $output['src'] = $result->getAttribute('src'); 
                $output['node'] = $result;
            }
        }
        
        else {$output= 'no results';}
        return $output;
    }

?>