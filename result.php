<?php
$countResult = 0;
$countInclude = 0;
$countExclude =0;

$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$max_records = $limit;
$page = isset($_GET['page']) ? $_GET['page'] : 1 ;
$offset = ($page - 1) * $limit;
$start_record = $offset;
$research_name = $_GET['research_name'];
$submit = $_GET['submit'];
$databases = $_GET['databases'];
$result = $_GET['result'];
$model = $_GET['model'];
$totalResult = 0;
$totalPages = 0;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// echo $actual_link;

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);


// echo "<br/><br/>";
// print_r($queries);


// echo "<br/><br/>";
// echo http_build_query($queries);

if (isset($_GET['submit'])) {
    $startDate = $_GET["startDate"];
    $finishDate = $_GET["finishDate"];
    $databases = $_GET['databases'];
    $model =  $_GET['model'];
    if($startDate > $finishDate){
        $temp = $startDate ;
        $startDate = $finishDate;
        $finishDate = $temp;
    }

    foreach ($databases as $databases){ 
        switch($databases){
            case 'IEEE':
                if(!isset($startDate) || trim($startDate) == ''){
                    $query = "http://ieeexploreapi.ieee.org/api/v1/search/articles?apikey=3xh9mgk6qu554d23taxmmn47&format=json&max_records=$max_records&start_record=$start_record&sort_order=asc&sort_field=publication_title&abstract=$keyword";
                }else{
                    $query = "http://ieeexploreapi.ieee.org/api/v1/search/articles?apikey=3xh9mgk6qu554d23taxmmn47&format=json&max_records=$max_records&start_record=$start_record&sort_order=asc&sort_field=publication_title&abstract=$keyword&start_year=$startDate&end_year=$finishDate";
                }										
                $url = file_get_contents($query);
                $data = json_decode($url, true);
                $data["data"] = $data['articles'];
                $temp_url = 'pdf_url';
                $size = sizeof($data['data']);
                $temp_year = 'publication_year';
                $totalResult = $data["total_records"];
            break;
            case 'Semantic Scholar':
                if(!isset($startDate) || trim($startDate) == ''){
                    $query = "https://api.semanticscholar.org/graph/v1/paper/search?query=$keyword&limit=$limit&offset=$offset&fields=title,authors,abstract,url,year";
                }else{
                    $query = "https://api.semanticscholar.org/graph/v1/paper/search?query=$keyword&limit=$limit&offset=$offset&fields=title,authors,abstract,url,year&year=$startDate-$finishDate";
                }
                $url = file_get_contents($query);
                $data = json_decode($url, true);
                $temp_url = 'url';
                $size = sizeof($data['data']);
                $temp_year = 'year';
                $totalResult = $data["total"];
            break;
            case "EPC":
                if($queries['page'] > 1){
                    $cursorMark = $queries['NextCursorMark'];
                    $cursorMark = preg_replace('/\s+/', '+', $cursorMark);
                    // echo $cursorMark;
                    $query = "https://www.ebi.ac.uk/europepmc/webservices/rest/search?query=$keyword&resultType=core&cursorMark=$cursorMark&pageSize=10&format=json";
                }else{
                    $cursorMark = "*";
                    $query = "https://www.ebi.ac.uk/europepmc/webservices/rest/search?query=$keyword&resultType=core&cursorMark=$cursorMark&pageSize=10&format=json";
                }
                $url = file_get_contents($query);
                $data = json_decode($url, true);
                $cursorMark = $data["nextCursorMark"];
                $size = sizeof($data["resultList"]["result"]);
                $totalResult = $data["hitCount"];
            break;
        }


        // Show Result
        if($queries['page'] >= 2){
            if(($queries['page']) * 10 >= $totalResult){
                echo "Show " . ($limit*($queries['page']-1)+1). "-" . ($limit+($totalResult-$limit)) . " from " . number_format($totalResult);
            }else{
                echo "Show " . ($limit*($queries['page'])-9) . "-" . $limit*($queries['page']) . " from " . number_format($totalResult);
            }
        }else{
            if(($queries['page']) * 10 >= $totalResult){
                echo "Show " . ($limit*($queries['page']-1)+1). "-" . ($limit+($totalResult-$limit)) . " from " . number_format($totalResult);
            }else{
                echo "Show " . ($limit*($queries['page'])-9) . "-" . $limit*($queries['page']) . " from " . number_format($totalResult);
            }
        }

        $results = $_GET['result'];
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
                    $publishedYear = $data["resultList"]["result"][$i]["pubYear"];

                    $name = "Author: ";
                    for ($a = 0; $a < sizeof($data["resultList"]["result"][$i]["authorList"]["author"]); $a++) {
                        $temp = $data["resultList"]["result"][$i]["authorList"]["author"][$a]["fullName"] . ", ";
                        $name .= $temp;
                    } 
                }
                $link = "<a href='$url'>$title</a>";
                $titleAbstract = $title . " " . $abstract;
                $txt = preg_replace('/\s+/', '+', $titleAbstract);
                if($model == "AI - TMJ"){
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
                }else{
                    $query = "https://slr-model-hzouxonooq-uc.a.run.app/predict?text=$txt";
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
                }

                // Cut Abstract Character
                if (strlen($abstract) > 350) {
                    $abstract = substr($abstract, 0, 350) . "<...>";
                }

                // Filter Tanggal
                include "showResult.php";
            }
?>

<div class="container">
    <div class="input-group pagination">
        <div class="input-group-btn">
        <?php
        $totalPages = $totalResult/10;
        $totalPages = ceil($totalPages);
            if(($queries['page']) * 10 >= $totalResult){
                include "prevButton.php";
            }else{
                include "prevButton.php";
                include "nextButton.php";
            }
    ?>
        </div>
    </div>
</div>

<?php
    }
}

if ($countResult == 0 && $countInclude == 0 && $countExclude == 0) {
    echo '<h4 class="empty text-center" style="color: rgba(141, 139, 139, 0.5);">Empty Data</h4>';
}
?>