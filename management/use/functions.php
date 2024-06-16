<?php

function display_recipe(array $recipe)
{
    $recipe_content = '';

    if ($recipe['is_enabled']) {
        $recipe_content = '<article>';
        $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
        $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
        $recipe_content .= '<i>' . $recipe['author'] . '</i>';
        $recipe_content .= '</article>';
    }
    
    return $recipe_content;
}

function display_users(array $users):array
{
    $users_content = '';

    
        $users_content = '<article>';
        $users_content .= '<h3>' . $users['email'] . '</h3>';
        $users_content .= '<div>' . $users['age'] . '</div>';
        $users_content .= '<i>' . $users['password'] . '</i>';
        $users_content .= '</article>';

    
    return $users_content;
}
function display_author(string $authorEmail, array $users)
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

function get_recipes(array $recipes, int $limit) : array
{
    $valid_recipes = [];
    $counter = 0;

    foreach($recipes as $recipe) {
        if ($counter == $limit) {
            return $valid_recipes;
        }

        if ($recipe['is_enabled']) {
            $valid_recipes[] = $recipe;
            $counter++;
        }
    }

    return $valid_recipes;
}

function get_users(array $users, int $limit) : array
{
    $valid_users = [];
    $counter = 0;

    foreach($users as $users) {
        if ($counter == $limit) {
            return $valid_users;
        }

        if ($users['full_name']) {
            $valid_users[] = $users;
            $counter++;
        }
    }

    return $valid_users;
}
