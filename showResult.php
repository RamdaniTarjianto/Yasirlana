<?php 
if(sizeof($results) == 1){
    switch($results[0]){
        case 'Included':
            if($response == "include"){
                echo '<div class="card-body">
                <h4 class="card-title">'.$link.'</h4>
                <p class="card-text">'.$abstract.'</p>
                <p class="card-text font-weight-bold">
                    '.$name.'
                </p>
                <p class="card-text d-flex">
                    <small class="text-muted mr-5">'.$publishedYear.','.$publisher.'</small>';
                    if ($response == "include") {
                        $countResult++;
                        $countInclude++;
                        echo '<span class="badge badge-success">include</span></p></div>';
                        echo '<hr height="3px" color="green" />';
                    }else {
                        $countResult++;
                        $countExclude++;
                        echo '<span class="badge badge-danger">exclude</span></p></div>';
                        echo '<hr height="3px" color="green" />';

                    }
            }	
        break;

        case 'Excluded':
            if($response == "exclude"){
                echo '<div class="card-body">
                <h4 class="card-title">'.$link.'</h4>
                <p class="card-text">'.$abstract.'</p>
                <p class="card-text font-weight-bold">
                    '.$name.'
                </p>
                <p class="card-text d-flex">
                    <small class="text-muted mr-5">'.$publishedYear.','.$publisher.'</small>';
                    if ($response == "include") {
                        $countResult++;
                        $countInclude++;
                        echo '<span class="badge badge-success">include</span></p></div>';
                        echo '<hr height="3px" color="green" />';
                    }else {
                        $countResult++;
                        $countExclude++;
                        echo '<span class="badge badge-danger">exclude</span></p></div>';
                        echo '<hr height="3px" color="green" />';
                    }
            }	
        break;
    }
}else{
    echo '<div class="card-body">
    <h4 class="card-title">'.$link.'</h4>
    <p class="card-text">'.$abstract.'</p>
    <p class="card-text font-weight-bold">
        '.$name.'
    </p>
    <p class="card-text d-flex">
        <small class="text-muted mr-5">'.$publishedYear.','.$publisher.'</small>';
        if ($response == "include") {
            $countResult++;
            $countInclude++;
            echo '<span class="badge badge-success">include</span></p></div>';
            echo '<hr height="3px" color="green" />';
        }else {
            $countResult++;
            $countExclude++;
            echo '<span class="badge badge-danger">exclude</span></p></div>';
            echo '<hr height="3px" color="green" />';
        }
}
?>