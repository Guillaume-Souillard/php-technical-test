# Init
echo "Salut à toi monsieur le lead dev de stadline, la configuration va se lancer :)"
echo "Création de la base de donnée"
php bin/console doctrine:database:create
echo "La base de donnée a bien été créée."

#Migrations
echo "Lancement des migrations"
php bin/console doctrine:migrations:migrate
echo "Migrations OK"

#Fixutes
## J'utilise ici les fixtures pour init des data de démoc
echo "Utilisation des fixtures pour data de démo"
php bin/console doctrine:fixtures:load
echo "fixtures OK"