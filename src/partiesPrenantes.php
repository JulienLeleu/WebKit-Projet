<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/styleInterfaceProjet.css" />
		<link rel="stylesheet" type="text/css" href="css/stylePartiesPrenantes.css" />
		<script src="js/jquery-1.11.2.js"></script>
        <meta charset="utf-8" />
        <title>Kit Projet - Parties prenantes</title>
    </head>
    <body>
		<div id="corps">
			<div id="entete">
				<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
				<a href="accueil.php"><img src="img/logoWebKitProjet.png"></a>
			</div>
			<?php 
				include('nav.php');
				getNav(8);
			?>
			<form action="#" method="GET">
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
				<div id="tableauPartiesPrenantes" >
					<table id="tableau" border="1px">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Entité</th>
								<th>Comité</th>
								<th>Site</th>
								<th>Fonction</th>
								<th>Rôle au sein du projet</th>
								<th>Tél</th>
								<th>Email</th>
								<th>Interne/Ext</th>
								<th>Périmètre</th>
								<th>Classification</th>
							</tr>
						</thead>
						<div id="scrollable">
						<tbody>
							<?php
							for($i=0;$i<50;$i++){
								echo '
							<tr>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
								<td><input type="text"></td>
							</tr>';
							}
							?>
						</tbody>
						</div>
					</table>
				</div>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
			</form>
		</div>
    </body>
</html>
<script>
$(document).ready(function(){
    makeTableHeadersSticky("#my_table");
});
 
function makeTableHeadersSticky(tableId)
{
    //collect widths of all the th elements
    var thArr = $(tableId + " th");
    //create an array to hold the auto calculated widths of each element
    var thWidthsArr = [];
    $(tableId + " th").each(function(){
        thWidthsArr.push($(this).css("width"));
    });
    var pos = $(tableId).offset();
    //set the distance of the table from the top,
    //we ll need to make the headers sticky when this distance is 0  
    var thTop = pos.top + "px";
    //set the widths of the first and last tr's ths/tds...
    //this is done coz in some cases,
    //the widths will get messed up if the data was generated dynamically
    var count = 0;
    $(tableId + " tr:first-child&gt;th").each(function(){
        $(this).css("width", thWidthsArr[count]);
        count++;
    });
    count = 0;
    $(tableId + " tr:last-child&gt;td").each(function(){
        $(this).css("width", thWidthsArr[count]);
        count++;
    });
    $(window).scroll(function(){
        if($(window).scrollTop() &gt; pos.top)
        {
            $(tableId + " tr:first-child").css("position", "fixed");
            $(tableId + " tr:first-child").css("top", "0px");
        }
        else
        {
            $(tableId + " tr:first-child").css("position", "relative");
            $(tableId + " tr:first-child").css("top", thTop);
        }
    });
}</script>