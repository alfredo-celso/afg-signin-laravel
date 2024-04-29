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
	font-size: 17px;
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
	font-size: 21px;
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
	require_once BASE_DIR . '/../app/models/2alpha-country-code.php';

	// $countryListFilePath pointing to JSON file
	$countryListFilePath = BASE_DIR . '/../app/models/2alpha_country_code.json';

	// Create an instance of the model Country List
	$countryList = new \CountryList();

	// Load JSON data
	$jsonDataCountryList = $countryList->loadJsonData($countryListFilePath);
?>

<div class="select-box">
	<div class="select-option">
		<input type="text" class="form-control" placeholder="Click or touch to search country" id="soValue" value="<?php echo $matchingRow['s_country'] ?>" readonly name="selectCitizen" required>
	</div>
	<div class="sub-content">
		<div class="search">
			<input type="text" class="form-control" id="optionSearch" placeholder="Search country" name="">
		</div>
		<ul class="options">
            <?php
                // Assuming $jsonData is your JSON data loaded from the model
                foreach ($jsonDataCountryList as $item) {
                    echo "<li>" . $item['Country'] . "</li>";
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