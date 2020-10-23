# Init
echo "Salut à toi monsieur le lead dev de stadline, la configuration va se lancer :)"
echo "Création de la base de donnée"
php bin/console doctrine:database:create
echo "La base de donnée a bien été créée."

#Migrations

#Fixutes
## J'utilise ici les fixtures pour init des data de démo
