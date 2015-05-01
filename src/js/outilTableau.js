	window.onload = function() {
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	};
	
	function addLinePartiePrenante(idTableau){
		var id = document.getElementById(idTableau).rows.length;
		var ligne = '<tr>';
		ligne += '<input type="hidden" name="idPartiePrenante[]" value="0">';
		ligne += '<td><input type="checkbox" name="trash' + id + '"></td>';
		ligne += '<td><label>' + id + '</label></td>';
		ligne += '<td><input type="text" name="nom[]"></td>';
		ligne += '<td><input type="text" name="entite[]"></td>';
		ligne += '<td><input type="text" name="comite[]"></td>';
		ligne += '<td><input type="text" name="site[]"></td>';
		ligne += '<td><input type="text" name="fonction[]"></td>';
		ligne += '<td><input type="text" name="role[]"></td>';
		ligne += '<td><input type="text" name="tel[]"></td>';
		ligne += '<td><input type="text" name="email[]"></td>';
		ligne += '<td><input type="text" name="interneExterne[]"></td>';
		ligne += '<td><input type="text" name="perimetre[]"></td>';
		ligne += '<td><input type="text" name="classification[]"></td>';
		ligne += '</tr>';
		$('#' + idTableau).append(ligne);
	}
	
	function addLineSuiviDesRisques(idTableau){
		var id = document.getElementById(idTableau).rows.length;
		var ligne = '<tr>';
		ligne += '<input type="hidden" name="idRisque[]" value="0">';
		ligne += '<td><input type="checkbox" name="trash' + id + '"></td>';
		ligne += '<td><label>' + id + '</label></td>';
		ligne += '<td><input type="text" name="theme[]"></td>';
		ligne += '<td><input type="text" name="chantier[]"></td>';
		ligne += '<td><input type="text" name="dateIdent[]"></td>';
		ligne += '<td><input type="text" name="echeance[]"></td>';
		ligne += '<td><input type="text" name="alerteVers[]"></td>';
		ligne += '<td><input type="text" name="typeDuRisque[]"></td>';
		ligne += '<td><input type="text" name="risqueIdentifie[]"></td>';
		ligne += '<td><input type="text" name="causeDuRisque[]"></td>';
		ligne += '<td><input type="text" name="detailsIncidencesSurProjet[]"></td>';
		ligne += '<td><input type="text" name="niveauImpact[]"></td>';
		ligne += '<td><input type="text" name="probabiliteOccurence[]"></td>';
		ligne += '<td><input type="text" name="actionAttenuation[]"></td>';
		ligne += '<td><input type="text" name="acteur[]"></td>';
		ligne += '<td><input type="text" name="statut[]"></td>';
		ligne += '<td><input type="text" name="etat[]"></td>';
		ligne += '</tr>';
		$('#' + idTableau).append(ligne);
	}
	
	function zoom(modif, id){
		var t = extractNumberOf(document.getElementById(id.toString()).style.fontSize);
		t = t + modif;
		document.getElementById(id.toString()).style.fontSize = t + "px";		
	}

	function extractNumberOf(text){
		var ar = "";
		var tmp = "";
		for (var i = 0; i < text.length; i++) {
			if (!isNaN(text.charAt(i))) { //Si c'est un nombre
				tmp = tmp + text.charAt(i).toString();
			}
		}
	return Number(tmp);
	}