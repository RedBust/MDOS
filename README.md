MDOS
====

Concept
-------

MDOS est un systeme de zombie, gerables a partir d'une interface Web securisee que je developpe, permettant de diriger les zombies pour leur faire accomplir differentes actions, notamment une attaque HTTP DoS et TCP SYN Flood, il faut donc pas mal de connaissances.
Il s'agit de creer une interface malleable, capable d'etre mise a jour de maniere aisee et de s'adapter aux connexions des clients compromis.

Fonctionnement
--------------

Pour l'attaque HTTP DoS, je pensais binder SlowLoris dans un programme en C++ ou C avec Qt ou autre, ça reste assez accessible.
Pour l'attaque TCP SYN Flood, un petit script bien fait suffira amplement.
C'est donc un systeme client infecte\master serveur classique, a ceci pret que le serveur principal est en PHP (=>TCP sous protocole HTTP), donc hebergable sur un serveur distant pour eviter la contrainte de l'IP (remonter a la source est plus facile avec des clients classiques).

Le zombie effectuera les attaques en lisant des informations a partir du master server heberge.
Le programme final sera donc l'interface en ligne PHP et le generateur de client.

Pour plus d'infos :
Un super cours de Polytech Grenoble sur les botnets, c'est vraiment une tuerie (plus axe sur les architectures centralisees) :
http://mescal.imag.f...ssi-Bremond.pdf