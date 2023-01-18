<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    set_time_limit(10000);
    if(isset($_GET['export'])){
            $key = $_GET['research_name'];
            $keyword = preg_replace('/\s+/', '+', $key);
            // echo $keyword;
            // $query = "https://api.semanticscholar.org/graph/v1/paper/search?query=$keyword&limit=50&fields=title,authors,abstract,url";
            // $url = file_get_contents($query);
            // $data = json_decode($url, true);
        
	}
    $startDate = $_GET["startDate"];
    $finishDate = $_GET["finishDate"];

    if($startDate > $finishDate){
        $temp = $startDate ;
        $startDate = $finishDate;
        $finishDate = $temp;
    }

    $limit = 10;
    $max_records = $limit;
    $page = $_GET['page'];
    $offset = ($page - 1) * $limit;
    $start_record = $offset;
    $keyword = $_GET['research_name'];
    $keyword = preg_replace('/\s+/', '+', $keyword);
    $databases = $_GET['databases'][0];
    $result = $_GET['result'];
    $model = $_GET['model'];
    $totalResult = 0;
    $totalPages = 0;
    $filename = "HasilExport" . "_" . $keyword . "_" . $startDate . "-" . $finishDate;
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$filename.xls");

?>

<form action="" method="get">
    <button class="btn-delete" id="export" name="exp">EXPORT</button>
</form>
<table border="1">
    <thead>
        <tr>
            <th>Title</th>
            <th>Abstract</th>
            <th>Publication Year</th>
            <th>Publisher</th>
            <th>Authors</th>
            <th>Result</th>
            <th>Document Link
            </th>
        </tr>
    </thead>

<?php
            // foreach ($databases as $databases){ 
                // echo $databases."<br />";
                switch($databases){
                    case 'IEEE':
                        if(!isset($startDate) || trim($startDate) == ''){
                            $query = "http://ieeexploreapi.ieee.org/api/v1/search/articles?apikey=3xh9mgk6qu554d23taxmmn47&format=json&max_records=300&sort_order=asc&sort_field=publication_title&abstract=$keyword";
                        }else{
                            $query = "http://ieeexploreapi.ieee.org/api/v1/search/articles?apikey=3xh9mgk6qu554d23taxmmn47&format=json&max_records=300&sort_order=asc&sort_field=publication_title&abstract=$keyword&start_year=$startDate&end_year=$finishDate";
                        }									
                        $url = file_get_contents($query);
                        $data = json_decode($url, true);
                        $data["data"] = $data['articles'];
                        $temp_url = 'pdf_url';
                        $size = sizeof($data['data']);
						$temp_year = 'publication_year';
                    break;
                    case 'Semantic Scholar':
                        if(!isset($startDate) || trim($startDate) == ''){
                            $query = "https://api.semanticscholar.org/graph/v1/paper/search?query=$keyword&limit=100&fields=title,authors,abstract,url,year";
                        }else{
                            $query = "https://api.semanticscholar.org/graph/v1/paper/search?query=$keyword&limit=100&fields=title,authors,abstract,url,year&year=$startDate-$finishDate";
                        }
                        $url = file_get_contents($query);
                        $data = json_decode($url, true);
                        $temp_url = 'url';
                        $size = sizeof($data['data']);
						$temp_year = 'year';
                    break;
                    case "EPC":
                        $query = "https://www.ebi.ac.uk/europepmc/webservices/rest/search?query=$keyword&resultType=core&pageSize=1000&format=json";
                        $url = file_get_contents($query);
                        $data = json_decode($url, true);
                        $size = sizeof($data["resultList"]["result"]);
                    break;
                }

                $results = $_GET['result'];
                // foreach ($results as $result){ 
                    for ($i = 0; $i < $size; $i++) {
                        if($databases != "EPC"){
                            $title = $data['data'][$i]['title'];
							$abstract = $data['data'][$i]['abstract'];
							$url = $data['data'][$i][$temp_url];
							$publishedYear = $data['data'][$i][$temp_year];
								if($databases == "IEEE"){
									$publisher = $data['data'][$i]["publisher"];
									$name = "Author: ";
									for ($a = 0; $a < sizeof($data['articles'][$i]["authors"]["authors"]); $a++) {
										$temp = $data['articles'][$i]["authors"]['authors'][$a]['full_name'] . ", ";
										$name .= $temp;
									} 
								}else{
									$name = "Author: ";
									for ($a = 0; $a < sizeof($data['data'][$i]["authors"]); $a++) {
										$temp = $data['data'][$i]["authors"][$a]['name'] . ", ";
										$name .= $temp;
									} 

								}
                        }else{
                            $title = $data["resultList"]["result"][$i]["title"];
                            $abstract = $data["resultList"]["result"][$i]["abstractText"];
                            $url = $data["resultList"]["result"][$i]["fullTextUrlList"]["fullTextUrl"][0]["url"];
                            $publisher = $data["resultList"]["result"][$i]["pubYear"];
                        }
                        $link = "<a href='$url'>$title</a>";
                        $titleAbstract = $title . " " . $abstract;
                        $txt = preg_replace('/\s+/', '+', $titleAbstract);
                        $query = "https://slr-deploy-hzouxonooq-uc.a.run.app/predict?text=$txt";
                        $curl = curl_init();
    
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $query,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_HTTPHEADER => array(
                                "Content-Length: 0"
                            ),
                        ));
    
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                            if(sizeof($results) == 1){
                                switch($result[0]){
                                    case 'Included':
                                        if($response == "include"){
                                            echo '<tr>';
                                            echo '<th scope="row" class="scope">' , $title , '</th>';
                                            echo '<td>' . $abstract . '</td>';
                                            echo '<td>' . $publishedYear . '</td>';
                                            echo '<td>' . $publisher . '</td>';
                                            echo '<td>' . $name . '</td>';
                                            if($response == "include"){
                                                echo '<td>' . $response . '</td>';
                                            }else{
                                                echo '<td>' . $response . '</td>';
                                            }
                                            echo '<td>' . $url . '</td>';
                                            echo '</tr>';

                                        }	
                                    break;

                                    case 'Excluded':
                                        if($response == "exclude"){
                                            echo '<tr>';
                                            echo '<th scope="row" class="scope">' , $title , '</th>';
                                            echo '<td>' . $abstract . '</td>';
                                            echo '<td>' . $publishedYear . '</td>';
                                            echo '<td>' . $publisher . '</td>';
                                            echo '<td>' . $name . '</td>';
                                            if($response == "include"){
                                                echo '<td>' . $response . '</td>';
                                            }else{
                                                echo '<td>' . $response . '</td>';
                                            }
                                            echo '<td>' . $url . '</td>';
                                            echo '</tr>';

                                        }	
                                    break;
                                }
                            }else{
                                echo '<tr>';
                                echo '<th scope="row" class="scope">' , $title , '</th>';
                                echo '<td>' . $abstract . '</td>';
                                echo '<td>' . $publishedYear . '</td>';
                                echo '<td>' . $publisher . '</td>';
                                echo '<td>' . $name . '</td>';
                                if($response == "include"){
                                    echo '<td>' . $response . '</td>';
                                }else{
                                    echo '<td>' . $response . '</td>';
                                }
                                echo '<td>' . $url . '</td>';
                                echo '</tr>';
                            }
                    }
                // }
            // }
        ?>
</table>