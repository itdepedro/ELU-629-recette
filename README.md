# ELU-629-Recettes (IMT Atlantique)

Sujet du projet
Le sujet du fil conducteur porte sur la création d’un site web participatif pour le partage de recettes culinaires entre les internautes du site. On distingue 4 catégories d’utilisateurs : l’administrateur, les contributeurs, les commentateurs et les visiteurs. Hormis les visiteurs, les trois autres catégories d’utilisateur devront s’authentifier pour accéder aux fonctionnalités du site. On dénombre trois fonctionnalités principales :

1) La gestion des utilisateurs authentifiés est assurée par l’administrateur. Ce dernier peut consulter la liste des utilisateurs, supprimer un utilisateur et bloquer le compte d’un utilisateur. La création d’un compte est faite automatiquement par le système sur demande des visiteurs. Les utilisateurs authentifiés peuvent modifier les informations de leur compte.
2) La gestion des recettes partagées par les contributeurs. Chaque contributeur gère (opérations CRUD) ses propres recettes. Un utilisateur authentifié devient contributeur dès qu’il dépose une recette sur le site. L’administrateur peut visualiser les recettes déposées par contributeur tandis que les visiteurs et les commentateurs peuvent consulter toutes les recettes disponibles ou effectuer des recherches sur les titres des recettes.
3) La gestion des commentaires associés aux recettes. Chaque utilisateur authentifié devient commentateur dès qu’il rédige un commentaire sur une recette donnée. Un contributeur ne peut pas commenter ses propres recettes mais il a la possibilité de commenter les recettes d’autrui. La gestion d’un commentaire (opérations CRUD) est assurée pas son commentateur ou l’administrateur qui joue ainsi le rôle de modérateur. Les visiteurs peuvent consulter les commentaires associés à une recette donnée.

Pour s’inscrire, un visiteur doit renseigner ses noms, prénoms, son adresse mail et son mot de passe. L’authentification se fait avec l’adresse mail et le mot de passe.

Un commentaire a un contenu et une date de rédaction. Il est associé à son rédacteur.

Une recette dispose au minium d’un titre, d’une liste d’ingrédients et d’un ensemble d’étapes ordonnées à suivre. Il est possible d’enrichir les caractéristiques d’une recette selon vos convenances. Vous avez aussi la possibilité de vous baser sur les caractéristiques d’une recette pratiqués durant les séances de travaux pratiques.

L’implémentation de la gestion des droits d’accès est facultative.
