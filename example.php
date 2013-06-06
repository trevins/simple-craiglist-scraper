  <head>

<link type="text/css" rel="stylesheet" href="http://www.trevinshirey.com/craigslist/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="http://www.trevinshirey.com/craigslist/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="http://www.trevinshirey.com/craigslist/css/bootstrap-responsive.css">
<link type="text/css" rel="stylesheet" href="http://www.trevinshirey.com/craigslist/css/bootstrap-responsive.min.css">
<link type="text/css" rel="stylesheet" href="http://www.trevinshirey.com/craigslist/css/docs.css">

<script src="http://www.trevinshirey.com/craigslist/js/bootstrap.js"></script>
    <script src="http://www.trevinshirey.com/craigslist/js/bootstrap.min.js"></script>


<script src="/craigslist/js/jquery-1.2.6.min.js" type="text/javascript"></script>
    <script src="/craigslist/js/jquery.tablesorter.js" type="text/javascript"></script> 


<script type="text/javascript">
        $(document).ready(function() {
            //Get the total count of the rows.
            var count = $("#tableOne tbody td:nth-child(1)").length;

            //Append the count to the text all ready in the first cell
            $("#tableOne tfoot td:first").append(count);

            //Starting with the fourth column compute the average of the scores
            for (i = 1; i <= 8; i++) {
                var total = 0;                

                //Get a set of all the scores from the current column
                var wrappedSet = $("#tableOne tbody").find("td:nth-child(" + i + ")");

                //Add the scores
                $(wrappedSet).each(function() {
                    $(this).css("text-align", "right");

                    //By using javascript Number() we can add things up and not concatenate strings
                    //Depending upon data might want to do some checking to make sure the text is a 
                    //number first
                    total += Number($(this).text());
                });

                //Compute the average and place it in the appropriate footer cell
                //Have to use javascript toFixed() to get a reasonable string
                $("#tableOne tfoot td:nth-child(" + i + ")")
                    .text((total / count).toFixed(6))
                    .css("text-align", "right");
            }

            $("#tableOne").tablesorter({ debug: false, sortList: [[3, 0]], widgets: ['zebra', 'columnHighlight'] })

        });                             
    </script>

</head>
<body>
<div class="container">

  <div class="marketing">

<table id="tableOne" class="table table-condensed">
<tbody>
<?php
$city = $_POST["city"];
$location = $_POST["location"];
$bedroom = $_POST["bedroom"];
$url1 = 'http://';
$url2 = '.craigslist.org/search/apa?zoomToPosting=&query=';
$url3 = '&srchType=A&minAsk=&maxAsk=&bedrooms=';

?>

Here's a list of prices for a <?php echo $bedroom ?>+ bedroom apartment in <?php echo $location ?> (<?php echo $city ?>). At the bottom of the list is the average montly rent. <a href="http://www.trevinshirey.com/craigslist">(go back and try it again)</a>

<?php
require("simpleScrape.php");

$scraper = new simpleScrape();

$scraper->sourceURL = "$url1$city$url2$location$url3$bedroom";  // Specify source to scrape
$scraper->scriptPath = "myscript.txt";  // Specify script file

$values = $scraper->scrape();  // Perform scrape and return results as array



foreach($values as $key=>$value)
{
for($index = 0; $index < Count($value); $index++)
{
echo "<tr><td> ".$value[$index]."</td></tr>";
}
}
?>
</tbody>
<tfoot>
</td>

	    <tr class="success">
	        <td>Average: </td>
</tr>
</tfoot>
</table>
<br />
</div>
</div>
</body>


