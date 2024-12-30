
<?php 
    require_once('config/process.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    
</head>
    <body>
        <table id="myTable">
            
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Date Submited</th>
            </tr>
            
            

        </table>
        <br>
        <form id="emailForm">
            <label for="email">
                Enter Your Email:
            </label>
            <input type="text" name="email" placeholder="John.Doe@email.com">
            <button type="submit" name="submit">Submit</button>
        </form>
    

    



<!--Jquerylink -->
<script src="config/DataTables/jquery.js"></script>



<script>
    $(document).ready(function(){

        function fetchData(){
            $.ajax({
                url: "config/process.php",
                type: "GET",
                dataType: "json",
                success: function(data){
                    console.log(data);

                    let table = $("#myTable");

                    table.find("tr:gt(0)").remove()

                    data.forEach(row => {
                        table.append(`<tr><td>${row.id}</td><td>${row.email}</td></tr>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Failed!");
                }
            });       
        }
        
        fetchData();


        

        $("#emailForm").on("submit", function(e){
            //e.preventDefault();

            const formData = $(this).serialize();
            $.ajax({
                url: "config/process.php",
                type: "POST",
                data: formData,
                success: function(response){
                    console.log('Form submitted successfully', response);

                    fetchData();

                    $('#emailForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Failed!");
                }
            });

        });

    });

</script>
</body>
</html>

    