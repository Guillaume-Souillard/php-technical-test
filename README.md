# StadLine Technical Test

## Installation

Mon projet tourne avec docker pour te faciliter l'installation.

Dans un premier temps prendre le .env.example, le copier coller et le renommer .env.

Ensuite, lancer la commande suivante `make` afin de lancer les différents container docker.

Tu peux ensuite rentrer dans le bash du container php avec cette commande `make bash`.

Lancer ensuite dans le bash `composer install` et ensuite mon petit script pour gérer la configuration avec la commande
suivante `sh install.sh`, toujours depuis le bash.

Ensuite, tu peux accéder à l'application en allant ici : http://localhost/

## Info de connexion au dashboard

Pour se connecter au dashboard, rien de plus simple, voici les infos:

mail: stadline@stadline.com

pass: stadline


## Temps réalisé sur le test && Conclusion
Temps réalisé: Environ 4heures.

Petite note vis à vis des tests, comme précisé à l'entretien, je suis complétement novice dans ce domaine
(aucun besoin dans mes anciennes boites ou projet perso). Mais j'ai quand même fait un petit test (avec la doc sous les
les yeux :P) qui permet de tester le fomulaire de création de course :P