<?php
    error_reporting(0);
    ini_set('display_errors', 0);
	set_time_limit(10000);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Automatic SLR API</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="author" content="colorlib.com">
        <link
            href="https://fonts.googleapis.com/css?family=Lato:400,600,700"
            rel="stylesheet"/>
        <link href="css/main.css" rel="stylesheet"/>
        <link href="css/checkbox.css" rel="stylesheet"/>
        <link
            href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700'
            rel='stylesheet'
            type='text/css'>

        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="css/style.css">

        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link
            href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
            rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>

        <div class="s009">
            <form action="" method="post" id="form1">
                <div class="inner-form">
                    <input type="hidden" name="currpage" value="1">
                    <div class="basic-search">
                        <div class="input-field">
                            <input
                                id="search"
                                type="text"
                                placeholder="Type Keywords"
                                name="research_name"
                                required="required">
                            <div class="icon-wrap">
                                <svg
                                    class="svg-inline--fa fa-search fa-w-16"
                                    fill="#ccc"
                                    aria-hidden="true"
                                    data-prefix="fas"
                                    data-icon="search"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 512 512">
                                    <path
                                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="advance-search">
                        <span class="desc">ADVANCED SEARCH</span>
                        <div class="row">
                            <div class="multiselect">
                                <div class="selectBox" onclick="showCheckboxes()">
                                    <select>
                                        <option disabled="disabled">Select Database</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxes">
                                    <label for="one">
                                        <input type="checkbox" id="one" name="databases[]" value="IEEE"/>IEEE</label>
                                    <label for="two">
                                        <input type="checkbox" id="two" name="databases[]" value="Semantic Scholar"/>Semantic Scholar</label>
                                    <label for="three">
                                        <input type="checkbox" id="three" name="databases[]" value="EPC"/>Europe PubMed Central</label>
                                </div>
                            </div>

                            <div class="multiselect">
                                <div class="selectBox" onclick="showCheckboxResult()">
                                    <select>
                                        <option>Select Result</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxResult">
                                    <label for="one">
                                        <input type="checkbox" id="one" name="result[]" value="Included"/>Included</label>
                                    <label for="two">
                                        <input type="checkbox" id="two" name="result[]" value="Excluded"/>Excluded</label>
                                </div>
                            </div>

                            <div class="multiselect">
                                <div class="selectBox">
                                    <select data-trigger="" name="model">
                                        <option selected="true" disabled="disabled">
                                            Select Model
                                        </option>
                                        <option>AI - TMJ</option>
                                    </select>
                                    <div></div>
                                </div>
                            </div>

                        </div>

                        <div class="row third">
                            <div class="input-field">
                                <div class="result-count">
                                    <!-- <span> </span>results -->
                                </div>

                                <div class="group-btn">
                                    <button
                                        class="btn-delete"
                                        id="export"
                                        onclick="submitForm('excel.php')"
                                        name="export">EXPORT</button>
                                    <button
                                        class="btn-search"
                                        name="submit"
                                        type="submit">SEARCH</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <?php 
		$key = $_POST['research_name'];
		$keyword = preg_replace('/\s+/', '+', $key);
	?>

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo '<h4 class="text-center mb-4">Search Result For ' . $key . '</h4>' ?>
                            <div class="table-wrap">
                                <table class="table">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th>Title</th>
                                            <th>Abstract</th>
                                            <th>Publication Year</th>
                                            <th>Publisher</th>
                                            <th>Authors</th>
                                            <th>Result</th>
                                            <!-- <th>Document URL</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
						$countResult = 0;
						$countInclude = 0;
						$countExclude =0;
						if($_POST['model'] === "Select Model"){
							echo '<script>alert("Please Select Your Model")</script>';
						}else{
							if (isset($_POST['submit'])) {
								$databases = $_POST['databases'];

								foreach ($databases as $databases){ 
									// echo $databases."<br />";
									switch($databases){
										case 'IEEE':										
											$query = "http://ieeexploreapi.ieee.org/api/v1/search/articles?apikey=3xh9mgk6qu554d23taxmmn47&format=json&max_records=300&start_record=1&sort_order=asc&sort_field=publication_title&abstract=$keyword";
											$url = file_get_contents($query);
											$data = json_decode($url, true);
											$data["data"] = $data['articles'];
											$temp_url = 'pdf_url';
											$size = sizeof($data['data']);
											$temp_year = 'publication_year';
										break;
										case 'Semantic Scholar':	
											$query = "https://api.semanticscholar.org/graph/v1/paper/search?query=$keyword&limit=100&fields=title,authors,abstract,url,year";
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

									$results = $_POST['result'];
									foreach ($results as $result){ 
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
											$query = "https://slrdeploy-z35x3o5coa-uc.a.run.app/predict?text=$txt";
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
												switch($result){
													case 'Included':
														if($response == "include"){
															echo '<tr>';
															echo '<th scope="row" class="scope">' , $link , '</th>';
															echo '<td>' . $abstract . '</td>';
															echo '<td>' . $publishedYear . '</td>';
															echo '<td>' . $publisher . '</td>';
															echo '<td>' . $name . '</td>';
															if($response == "include"){
																$countResult++;
																$countInclude++;
																echo '<td><a href="" class="btn btn-success">' . $response . '</a></td>';
															}else{
																$countResult++;
																$countExclude++;
																echo '<td><a href="" class="btn btn-danger">' . $response . '</a></td>';
															}
															// echo '<td>' . $url . '</td>';
															echo '</tr>';

														}	
													break;

													case 'Excluded':
														if($response == "exclude"){
															echo '<tr>';
															echo '<th scope="row" class="scope">' , $link , '</th>';
															echo '<td>' . $abstract . '</td>';
															echo '<td>' . $publishedYear . '</td>';
															echo '<td>' . $publisher . '</td>';
															echo '<td>' . $name . '</td>';
															if($response == "include"){
																$countResult++;
																$countInclude++;
																echo '<td><a href="" class="btn btn-success">' . $response . '</a></td>';
															}else{
																$countResult++;
																$countExclude++;
																echo '<td><a href="" class="btn btn-danger">' . $response . '</a></td>';
															}
															// echo '<td>' . $url . '</td>';
															echo '</tr>';

														}	
													break;
												}
											}else{
												echo '<tr>';
												echo '<th scope="row" class="scope">' , $link , '</th>';
												echo '<td>' . $abstract . '</td>';
												echo '<td>' . $publishedYear . '</td>';
												echo '<td>' . $publisher . '</td>';
												echo '<td>' . $name . '</td>';
												if($response == "include"){
													echo '<td><a href="" class="btn btn-success">' . $response . '</a></td>';
													$countResult++;
													$countInclude++;
												}else{
													echo '<td><a href="" class="btn btn-danger">' . $response . '</a></td>';
													$countResult++;
													$countExclude++;
												}
												// echo '<td>' . $url . '</td>';
												echo '</tr>';
											}
										}
									}
								}
							}
						}
					?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="result-count">
                <span>
                    <?php echo $countResult ?>
                </span>
                results</div>
            <span>
                <?php echo $countInclude ?>
            </span>
            includes</div>
        <span>
            <?php echo $countExclude ?>
        </span>
        excludes</div>
</div>

<script src="js/extention/checkbox.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/extention/choices.js"></script>
<script>
    const customSelects = document.querySelectorAll("select");
    const deleteBtn = document.getElementById('delete')
    const choices = new Choices('select', {
        searchEnabled: false,
        itemSelectText: '',
        removeItemButton: true
    });
</script>

<script type="text/javascript">
    function submitForm(action) {
        var form = document.getElementById('form1');
        form.action = action;
        form.submit();
    }
</script>

</body>
</html>