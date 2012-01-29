MDOS
====

Concept
-------

MDOS est un système de zombie, gérables à partir d'une interface Web sécurisée que je développe, permettant de diriger les zombies pour leur faire accomplir différentes actions, notamment une attaque HTTP DoS et TCP SYN Flood, il faut donc pas mal de connaissances.
Il s'agit de créer une interface malléable, capable d'être mise à jour de manière aisée et de s'adapter aux connexions des clients compromis.

Fonctionnement
--------------

Pour l'attaque HTTP DoS, je pensais binder SlowLoris dans un programme en C++ ou C avec Qt ou autre, ça reste assez accessible.
Pour l'attaque TCP SYN Flood, un petit script bien fait suffira amplement.
C'est donc un système client infecté\master serveur classique, à ceci prêt que le serveur principal est en PHP (=>TCP sous protocole HTTP), donc hébergable sur un serveur distant pour éviter la contrainte de l'IP (remonter à la source est plus facile avec des clients classiques).

Le zombie effectuera les attaques en lisant des informations à partir du master server hébergé.
Le programme final sera donc l'interface en ligne PHP et le générateur de client.

Pour plus d'infos :
Un super cours de Polytech Grenoble sur les botnets, c'est vraiment une tuerie (plus axé sur les architectures centralisées) :
http://mescal.imag.f...ssi-Bremond.pdf