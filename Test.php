    <form>
        <select name="cities" id="city">
            <?php 
                require_once 'connect_db.php';
                $sql = "SELECT * FROM Cities"; 
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    ?>
                    <option value="<?php echo $row["cityID"]; ?>"><?php echo $row["city_name"]; ?></option>
                    <?php 
                }
                sqlsrv_free_stmt($stmt);
            ?>
        </select>

        <select name="districts" id="district">
            <!-- District options will be populated dynamically using JavaScript -->
        </select>
    </form>

    <script>
        var citySelect = document.getElementById("city");
        var districtSelect = document.getElementById("district");

        // Event listener for the city select change
        citySelect.addEventListener("change", function() {
            var cityId = citySelect.value;
            
            // Clear existing options
            districtSelect.innerHTML = "";

            // AJAX request to fetch districts based on the selected city
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_districts.php?cityId=" + cityId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var districts = JSON.parse(xhr.responseText);
                    districts.forEach(function(district) {
                        var option = document.createElement("option");
                        option.value = district.districtID;
                        option.text = district.district_name;
                        districtSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        });
    </script>
