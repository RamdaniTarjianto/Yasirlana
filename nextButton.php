<?php 
$queries['page']=$page+1;
$queries['limit']=$limit;
$nextCM = $data["nextCursorMark"];
// $queries['max_records']=$max_records;
// $queries['start_record']=$start_record;
$query_string_next = http_build_query($queries);?>

<!-- <a href="searching.php?<?php //echo $query_string_next . "&NextCursorMark=$nextCM" ?>">
    Next</a> -->
<button class="btn btn-default" id="nextButon" type="button"><a class="" href="searching.php?<?php echo $query_string_next . "&NextCursorMark=$nextCM" ?>">Next</a></button>
<!-- <li class="page-item"><a class="page-link" href="searching.php?<?php //echo $query_string_next . "&NextCursorMark=$nextCM" ?>">Next</a></li> -->
