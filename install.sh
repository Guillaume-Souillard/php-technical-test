# Init
echo "Salut à toi monsieur le lead dev de stadline, la configuration va se lancer :)"
echo "Création de la base de donnée"
php bin/console doctrine:database:create
echo "La base de donnée a bien été créée."

#Migrations
echo "Lancement des migrations"
php bin/console doctrine:migrations:migrate -n
echo "Migrations OK"

#Fixutes
## J'utilise ici les fixtures pour init des data de démoc
echo "Utilisation des fixtures pour data de démo"
php bin/console doctrine:fixtures:load -n
echo "fixtures OK"

echo "Tu peux maintenant te rendre https://localhost et te connecter avec mail: stadline@stadline.com et pass: stadline"