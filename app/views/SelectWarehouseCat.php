<style>
.select-box{
	margin-top: 1px;
	width: 100%;
	position: relative;
}

.select-option{
	position: relative;
}

.select-option input{
	width: 100%;
	background-color: #fff;
	color: #000;
	border-radius: 7px;
	cursor: pointer;
	font-size: 15px;
	padding: 5px 10px;
	border: 1 !important;
	outline: 0 !important;
}

.select-option:after{
	content:"";
	border-top: 12px solid #000;
	border-left: 8px solid transparent;
	border-right: 8px solid transparent;
	position: absolute;
	right: 15px;
	top: 50%;
	margin-top: -8px;
}

.sub-content{
	background-color: #fff;
	position: absolute;
	color: #000;
	border-radius: 7px;
	margin-top: 5px;
	width: 100%;
	z-index: 999;
	padding: 20px;
	display: none;
}

.search{
	width: 100%;
	font-size: 15px;
	padding: 5px;
	outline: 0;
	border: 1px solid #b3b3b3;
	border-radius: 5px;
}

.options{
	margin-top: 10px;
	max-height: 250px;
	overflow-y: auto;
	padding: 0;
}

.options li{
	padding: 5px 10px;
	border-radius: 5px;
	font-size: 15px;
	cursor: pointer;
	border-bottom: 1px solid gray;
}

.options li:hover{
	background-color: #f2f2f2;
}

.select-box.active .sub-content{
	display: block;
}

.select-box.active .select-option:after{
	transform: rotate(-180deg);
}
</style>

<?php

    define('BASE_DIR', __DIR__);
    // Correct the include path for config.php
    $configFilePath = BASE_DIR . '/../config.php';
    if (!file_exists($configFilePath)) {
        echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-triangle-exclamation'></i> ERROR: config.php file doest not exist or not found. </div>";
    }
    // labels
    $labels = include $configFilePath;


    // Include the file where your database connection is established
    require_once BASE_DIR . '/../app/models/cnx-db-aux.php';


    $sql = "select * from view_warehouse_cat";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch the results into an associative array
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $numRows = count($results);

    if ($numRows === 0) {
        echo "<div style='background-color: yellow; color: black;'><i class='fa-solid fa-triangle-exclamation'></i> WARNING: No records match with TC </div>";
    } else {

    	// Load JSON data
	    $jsonDataCatList = $results;

    }

?>

<div class="select-box">
	<div class="select-option">
		<input type="text" class="form-control" placeholder="Click or touch to search Category" id="soValue" value="<?php echo $matchingRow['Description'] ?>" readonly name="selectCat" required>
	</div>
	<div class="sub-content">
		<div class="search">
			<input type="text" class="form-control" id="optionSearch" placeholder="Search category" name="">
		</div>
		<ul class="options">
            <?php
                // Assuming $jsonData is your JSON data loaded from the model
                foreach ($jsonDataCatList as $item) {
                    echo "<li>" . $item['Description'] . "</li>";
                }
            ?>
		</ul>

	</div>
</div>

<script>
    const selectBox = document.querySelector('.select-box');
    const selectOption = document.querySelector('.select-option');
    const soValue = document.querySelector('#soValue');
    const optionSearch = document.querySelector('#optionSearch');
    const options = document.querySelector('.options');
    const optionsList = document.querySelectorAll('.options li');

    selectOption.addEventListener('click', function(){
        selectBox.classList.toggle('active');
    });

    optionsList.forEach(function(optionsListSingle){
        optionsListSingle.addEventListener('click', function(){
            text = this.textContent;
            soValue.value = text;
            selectBox.classList.remove('active');
        })
    });

    optionSearch.addEventListener('keyup', function(){
        var filter, li, i, textValue;
        filter = optionSearch.value.toUpperCase();
        li = options.getElementsByTagName('li');
        for(let i = 0; i < li.length; i++){
            liCount = li[i];
            textValue = liCount.textContent || liCount.innerText;
            if(textValue.toUpperCase().indexOf(filter) > -1){
                li[i].style.display = '';
            }else{
                li[i].style.display = 'none';
            }
        }	
    });
</script>