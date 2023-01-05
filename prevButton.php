<?php 
// $queries['page']=$page-1;
// $queries['limit']=$limit;
// $queries['max_records']=$max_records;
// $queries['start_record']=$start_record;
// if($databases[0] == "EPC"){
//     $query_string_prev = "javascript:history.go(-1)";
// }else{
//     $query_string_prev = "searching.php?" . http_build_query($queries);
// }
?>

<?php
    $queries['page'] = $_POST['halaman'];
    $query_string_go = http_build_query($queries);
?>

<button class="btn btn-default" type="">
    <a class="" href="javascript:history.go(-1)">Prev</a>
</button>
<!-- <li class="page-item"><a class="page-link"
href="javascript:history.go(-1)">Previous</a></li> -->
</div>
<div class="input-group-btn">
<form name="form2" id="form2">
    <input
        type="number"
        class="form-control page-item"
        name="halaman"
        id="halaman"
        style="width: 50px;"
        value="<?= $_GET['page'] ?>"/>

</div>
<div class="input-group-btn">
    <button class="btn btn-primary" name="go" type="submit">go</button>
</form>

<script>
    const url = '<?php echo $query_string_go ?>';
    const pageEl = document.getElementById('halaman');
    const formEl = document.getElementById('form2');

    formEl.addEventListener('submit', (e) => {
        const objUrl = new URLSearchParams(url);
        e.preventDefault();
        objUrl.set('page', pageEl.value)
        let currUrl = window.location.origin + window.location.pathname;

        window
            .location
            .replace(`${currUrl}?${objUrl.toString()}`)
    })
</script>