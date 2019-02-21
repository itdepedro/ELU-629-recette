************ ENGLISH VERSION **************

Before start, it is necessary to config the folder ELU-629-Recettes in your server.

1. Database configuration:

Inside BD folder, there are two files: "code SQL" and "recette.sql". There are two options to config the database:
..1. Copy/Paste the text inside the "code SQL" file into a database already created named "recette"
..2. Import the content of the "recette.sql" file into the database called "recette"

2. Inside the file named "include", we can find "setup.php" which we have to config with: server name, username, password and database information. 

3. Now we can access our webpage typing in a web browser http://localhost:8888 (localhost case, it could change). In the main page we find one recipe. We can also find the login menu.

4. Now we can test the webpage. We have already created 4 users:

Username----password
....................
admin-------pass
antoine-----pass
camille-----pass
jacques-----pass

The main user is admin. This user can create recipes, but he can also moderate them. In this example, there ir one recipe didn't validate. In order to accept/decline it we should go to the administration tab (after click in the three lines button). In this section we can moderate both the recipes and the users.


************ VERSION FRANCAISE *************
Avant de d�marrer, il faut copier le dossier ELU-629-Recettes dans votre serveur web. 

1. Configuration de la base de donn�es: 

� l'int�rieur du dossier BD, il y a deux fichiers. Ici, on pr�sente deux possibilit�s pour configurer la base de donn�es:
..1.Le contenu du fichier "codeSQL" doit �tre copi� et coll� dans une base de donn�es qu'il faut appeler "recette".
..2.Le fichier "recette.sql" peut �tre import� dans une base de donn�es appell�e "recette". 


2. Dans le dossier "include", on trouve le fichier "setup.php", o� on configure la connexion � la base de donn�es. Il faut mettre les param�tres correspondant � la 
localisation de la base de donn�es, le nom d'utilisateur, le mot de passe et le nom de la base de donn�es (ce derni�re si on utilise une base de donn�es diff�rente). 

3. Une fois cela a �t� fait, on peut acc�der � la page web depuis un navigateur en �crivant l'adresse du dossier "ELU-629-Recettes/". On peut maintenant visualiser 
la page d'accueil, o� on trouve aussi les derni�res recettes publi�es. On trouve un m�nu permettant de s'inscrire ou de se logger. 

4. Maintenant il ne reste qu'� tester la page web: 
Pour tester la page web, il y a 4 utilisateurs. 

..... Utilisateur   Mot de passe
..... admin         pass          
..... antoine       pass          
..... camille       pass          
..... jacques       pass          

L'utilisateur admin est l'administrateur de la page. Il peut cr�er des recettes, mais il est aussi mod�rateur. Dans l'exemple, si on initialise une session
admin, il y a une recette en attente de validation qui peut �tre visualis�e dans l'option "administration". On peut aussi les status des diff�rents utilisateurs. 
Dans cet exemple, l'utilisateur "admin" est l'auteur de la recette "�glefin lard�". Il ne peut pas commenter sa propre recette, mais comme il a les droits de 
mod�rateur, il peut modifier les autres commentaires ou les effacer. 

Les autres utilisateurs ne sont pas administrateurs (initialement, car un administrateur peut les rendre administrateurs aussi dans l'option administration). 
Ils peuvent publier des recettes, visualiser et commenter les recettes dont ils ne sont pas les auteurs et modifier ou effacer leurs propres 
commentaires. Dans l'exemple propos�, la recette qui est en attente de validation a �t� publi�e par l'utilisateur "antoine". 


