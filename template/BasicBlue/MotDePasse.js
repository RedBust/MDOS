// Fichier JScript
// ctl00_ContentPlaceHolder1_btnModifier" disabled="disabled"
var MinCaracteres = 5; // Nombre minimum de caratères du mot de passe
var CaracteresSecurite = 7; // Nombre de caractères correct pour un mot de passe
var SecuriteBouton = 2; // Niveau de sécurité pour dévérouiller le bouton Faible : 1, Moyen : 2, Fort : 3

// images des différents niveaux
var PicSecurite = new Array();
PicSecurite[0] = "template/BasicBlue/NiveauZero.png";
PicSecurite[1] = "template/BasicBlue/NiveauFaible.png";
PicSecurite[2] = "template/BasicBlue/NiveauMoyen.png";
PicSecurite[3] = "template/BasicBlue/NiveauFort.png";

var preLoadSecurite = new Array();

for (i = 0; i < 4; i++){
   preLoadSecurite[i] = new Image();
   preLoadSecurite[i].src = PicSecurite[i];
}

function NiveauSecurite()
{
    // pwd : Mot de passe à vérifier
    var pwd = document.getElementById("txtPdw").value ;

    if (IsStrong(pwd))
    {
	    document.getElementById("imgNiveauSecurite").src = preLoadSecurite[3].src;
	    document.getElementById("btnValider").disabled = false;
    }
    else if (IsMedium(pwd))
    {
	    document.getElementById("imgNiveauSecurite").src = preLoadSecurite[2].src;
 	    if (SecuriteBouton<=2)
	    {
	        document.getElementById("btnValider").disabled = false;
	    }else{
	        document.getElementById("btnValider").disabled = true;
	    }
    }
    else if (IsWeak(pwd))
    {
	    document.getElementById("imgNiveauSecurite").src = preLoadSecurite[1].src;
 	    if (SecuriteBouton<=1)
	    {
	        document.getElementById("btnValider").disabled = false;
	    }else{
	        document.getElementById("btnValider").disabled = true;
	    }
    }
    else
    {
	    document.getElementById("imgNiveauSecurite").src = preLoadSecurite[0].src;
	    document.getElementById("btnValider").disabled = true;
    }
}

function IsStrong(pwd)
{
// niveau Fort
	if (pwd.length < CaracteresSecurite)
	{
		return false;
	}else{
        if (!SpansAtLeastNCharacterSets(pwd,3))
        {
        	return false;
        }else{
		    return true;
		}
	}
}

function IsMedium(pwd)
{
// niveau Moyen
	if (pwd.length < CaracteresSecurite)
	{
		return false;
	}else{
        if (!SpansAtLeastNCharacterSets(pwd,2))
        {
        	return false;
        }else{
		    return true;
		}
	}
}

function IsWeak(pwd)
{
// niveau Faible
	return (pwd.length >= (MinCaracteres));
}

function SpansAtLeastNCharacterSets( word, N)
{
// Calcul les différents types de caractères du mot de passe
// word : mot de passe, N : Nombre minimun de types de caractère différents pour retour à vrai
	if (word == null)
		return false;

	var csets = new Array(false,false,false,false);

	ncs = 0;
	var listeNombre = "0123456789";
	var listeCaractereSpe = "&é'(-è_çà)=*ù!:;,?./§-+<>$£µ%"+'"';
    for (i = 0; i < word.length; i++)
	{
	    c= word.charAt(i);
		if (listeNombre.indexOf(c)>=0)
		{
		// caractère numérique
			if (csets[0] == false)
			{
				csets[0] = true;
				ncs++;
				if (ncs >= N)
					return true;
			}
		}
		else if (listeCaractereSpe.indexOf(c)>=0)
		{
		// caractère spécial
			if (csets[1] == false)
			{
				csets[1] = true;
				ncs++;
				if (ncs >= N)
					return true;
			}
		}
		else if (c.toUpperCase() ==c)
		{
		// caractère en Majuscule
			if (!csets[2])
			{
				csets[2] = true;
				ncs++;
				if (ncs >= N)
					return true;
			}
			continue;
		}
		else if (c.toLowerCase() ==c)
		{
		// caractère en Minuscule
			if (!csets[3])
			{
				csets[3] = true;
				ncs++;
				if (ncs >= N)
					return true;
			}
		}
	}
	return false;
}

