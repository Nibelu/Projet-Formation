





function change_onglet(name)
    {
		document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 button alt';
		document.getElementById('onglet_'+name).className = 'onglet_1 button';
		document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
		document.getElementById('contenu_onglet_'+name).style.display = 'block';
		anc_onglet = name;
    }
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() 
	{
		modal.style.display = "block";
	}

// When the user clicks on <span> (x), close the modal
span.onclick = function() 
	{
		modal.style.display = "none";
	}

// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) 
	{
		if (event.target == modal) 
		{
			modal.style.display = "none";
		}
	}
var anc_onglet = 'Connexion';
change_onglet(anc_onglet);
				