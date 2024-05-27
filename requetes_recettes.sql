
/*Afficher toutes les recettes disponibles(nom, catégorie et temps de préparation) triée de façon décroissantesur la durée de réalisation.*/
SELECT recipe.recipe_name, recipe.preparation_time, category.name
FROM recipe
INNER JOIN category
ON category.id_category = recipe.id_category
ORDER BY recipe.preparation_time DESC;

/*2-En modifiant la requête précédente, faites apparaitre le nomre d'ingrédients nécessaire par recette*/
SELECT recipe.recipe_name, recipe.preparation_time, recipe_ingredient.quantity
FROM recipe
INNER JOIN recipe_ingredient
ON recipe.id_recipe = recipe_ingredient.id_recipe;

/*3-Afficher les recettes qui nécessitent au moins 30 minutes de préparation*/
SELECT recipe.recipe_name, recipe.preparation_time
FROM recipe
WHERE recipe.preparation_time > 30;

/*4-Afficher les recettes dont le nom contient le mot "salade"*/
SELECT recipe.recipe_name
FROM recipe
WHERE recipe.recipe_name LIKE '%salade%';

/*5-Insérer une nouvelle recette "pâtes à la carbonara" dont la durée de réalisation est de 20minutes avec les instructions de fvotre choix.Pensez à alimenter votre base de donne=és en conséquences afin de pouvoir lister les détails de cette recettes(ingrédients).*/
INSERT INTO recipe (recipe_name, preparation_time, instructions, id_category)
VALUES ('pâtes à la carbonara', '20', 'instructions', 2);

INSERT INTO recipe_ingredient (id_recipe, id_ingredient, quantity)
VALUES (12, 5, 200);

INSERT INTO recipe_ingredient (id_recipe, id_ingredient, quantity)
VALUES (12, 7, 300);

/*6- Modifier le nom de la recette ayant comme identifiant id_recette = 3 (nom de la recette à votre convenance)*/
UPDATE recipe
SET recipe.recipe_name = 'Ile flottante'
WHERE id_recipe=7;

/*7-Supprimer la recette n°2 de la base de donnée

DELETE FROM recipe
WHERE id_recipe = 2;*/

/*8-Afficher le prix total de la recette numéro 5*/
SELECT SUM(price*quantity) AS recipe_price
FROM ingredient
INNER JOIN recipe_ingredient
ON ingredient.id_ingredient = recipe_ingredient.id_ingredient
WHERE id_recipe = 7;

/*9-Afficher le détail de la recette numéro 5(liste des ingrédients, quantités et prix)*/

SELECT ingredient_name, recipe_ingredient.quantity, (price*quantity) AS recipe_price
FROM ingredient
INNER JOIN recipe_ingredient
ON ingredient.id_ingredient = recipe_ingredient.id_ingredient
WHERE id_recipe=7;

/*10-Ajoutez un ingrédients en base de données : poivre, unité : cuillère à café, prix:2,50*/

INSERT INTO ingredient (ingredient_name, unity, price)
VALUES ('poivre', 'cuillère à café', 2.50);

/*11-Modifiez le prix de l'ingrédient numéro 12. */

UPDATE ingredient
SET price = 6
WHERE id_ingredient = 7;

/*12-Afficher le nombre de recette par catégories*/

SELECT category.name, COUNT(id_recipe) AS number_meal
FROM recipe
INNER JOIN category
ON recipe.id_category = category.id_category
GROUP BY category.id_category;

/*13-Afficher les recettes qui contiennent l'ingrédient "poulet" */
SELECT recipe.recipe_name
FROM recipe
INNER JOIN recipe_ingredient ON recipe.id_recipe = recipe_ingredient.id_recipe
INNER JOIN ingredient ON recipe_ingredient.id_ingredient = ingredient.id_ingredient
WHERE ingredient.ingredient_name LIKE '%poulet%';

/*14-Mettez à jour toutes les recettes en diminuant leur temps de préparation de 5 minutes */
UPDATE recipe
SET preparation_time = (preparation_time - 5)
WHERE preparation_time > 5;

/*15-Afficher les recettes qui ne nécessite pas d'ingrédients coûtant plus de 2€ l'unité.*/
SELECT DISTINCT recipe.recipe_name
FROM recipe
INNER JOIN recipe_ingredient
ON recipe.id_recipe = recipe_ingredient.id_recipe
INNER JOIN ingredient
ON recipe_ingredient.id_ingredient = ingredient.id_ingredient
WHERE ingredient.price < 2;

/*16-Afficher la/les recettes les plus rapides à préparer.*/

SELECT DISTINCT recipe.recipe_name, recipe.preparation_time
FROM recipe
WHERE preparation_time = ( SELECT MIN(preparation_time) FROM recipe);

/*17-Trouver les recettes qui ne nécessitent aucun ingrédient (par exemple la recette de la tasse d'eau cha	ude qui consiste à verser de l'eau chaude dans une tasse)*/

SELECT recipe.name_recipe 
FROM recipe
WHERE id_recipe NOT IN (
SELECT id_recipe
FROM recipe_ingredient
WHERE recipe_ingredient.id_recipe = recipe.id_recipe);


