<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/home.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <title>Eggspired</title>
</head>

<body>
    <div id="overlay">
        <img id="transition" src="e.png" style="width:50%" />
    </div>
    <div id="myDIV" class="header">
        <h2 style="margin:5px; font-color:black">Oct. 27</h2>
		<hr>
        <!--User inputs text-->
        <input type="text" id="myInput" placeholder="Item Name...">
        <!--Transfer input to new element checkbox-->
        <span onclick="newElement()" class="addBtn">Add</span>
    </div>

    <!--List-->
	
    <ul id="myUL" style="font-family: Quicksand; sans-serf;"></ul>

    <script>

        // Create a "close" button and append it to each list item
        var myNodelist = document.getElementsByTagName("LI");
        var i;
        for (i = 0; i < myNodelist.length; i++) {
            var span = document.createElement("SPAN");
            var txt = document.createTextNode("\u00D7");
            span.className = "close";
            span.appendChild(txt);
            myNodelist[i].appendChild(span);
        }

        // Click on a close button to hide the current list item
        var close = document.getElementsByClassName("close");
        var i;
        for (i = 0; i < close.length; i++) {
            close[i].onclick = function () {
                var div = this.parentElement;
                div.style.display = "none";
            }
        }
		var inputValue;
        // Add a "checked" symbol when clicking on a list item
        var list = document.querySelector('ul');
        list.addEventListener('click', function (ev) {
            if (ev.target.tagName === 'LI') {
                ev.target.classList.toggle('checked');
				$.post("/eggspired/get.php", { item: inputValue })

            }
        }, false);

        var stringList = [];
	
        // Create a new list item when clicking on the "Add" button
        function newElement() {
            var li = document.createElement("li");
            inputValue = document.getElementById("myInput").value;
            var t = document.createTextNode(inputValue);
            stringList.push(inputValue);
            li.appendChild(t);
            //case where input value is not inside database?
            if (inputValue === '') {
                alert("No item found. Please check your input again!");
            } else {
                document.getElementById("myUL").appendChild(li);
            }
            //Resets user input text box to empty
            document.getElementById("myInput").value = "";

            var span = document.createElement("SPAN");
            var txt = document.createTextNode("\u00D7");
            span.className = "close";
            span.appendChild(txt);
            li.appendChild(span);

            for (i = 0; i < close.length; i++) {
                close[i].onclick = function () {
                    var div = this.parentElement;
                    div.style.display = "none";
                }
            }
        }
        //Removes starter image after a short delay
        setTimeout(function () {
            $("#overlay").remove();
        }, 2500);

    	setInterval("my_function();",5000); 
		function my_function(){
      $('#refresh').load(location.href + ' #time')
	  }


    </script>
    <div class="header" id="myDIV"	>
	<hr style="margin-top:0rem !important"/>
	</div>
    <div id="refresh" class="header">
        <div id="time">
            <?php
            define('DB_NAME', 'csv_db');
            define('DB_USER', 'root');
            define('DB_PASSWORD', '');
            define('DB_HOST', 'localhost');
            $link=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if(!$link){
            die('Could not connect:' . mysqli_connect_error());
            }

            $db_selected = mysqli_select_db ( $link,DB_NAME);

            if(!$db_selected){
            die('Can\'t use' . DB_NAME . ':' . mysqli_connect_error() );
            }


            $result=mysqli_query($link, "SELECT item_name, expiration FROM bag");

            echo "<table>
                <tr></tr>";

                while ($row=mysqli_fetch_array($result)) {
                echo "
                <tr>
                    ";
                    echo "
                    <td>" . $row['item_name'] . "</td>";
                    echo "
                    <td>" . $row['expiration'] . "</td>";
                    echo"
                </tr>";
                }
                echo "
            </table>";

            mysqli_close($link);

            ?>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>