<?php
namespace Axxa\src\Utils\Sanitize;
Use Axxa\src\Controller\FrontController;
Use Axxa\src\Entity\Categorie;
/**
 * Description of categSenitize
 * @author axxa
 */
class categSenitize {

    public function categSanitize() {
        if (!isset($_SESSION["admin_user_id"]) || empty($_SESSION["admin_user_id"]) || !is_numeric($_SESSION["admin_user_id"]) || !is_numeric($_SESSION["access_level"]) || $_SESSION["access_level"] != 1) {
            require_once dirname(__FILE__) . "Entity/Categorie.php";
            $result = getCategories(0);
        } else {
            $msg = "";

            require_once dirname(__FILE__) . "Entity/Categorie.php";

            $get_action = isset($_GET["action"]) ? $_GET["action"] : "";
            $get_id = isset($_GET["user_id"]) ? $_GET["user_id"] : 0;

// recuperer les variables
            $post_categorie = isset($_POST["categorie"]) ? $_POST["categorie"] : "";
            $post_description = isset($_POST["description"]) ? $_POST["description"] : "";
            $post_is_visible = isset($_POST["is_visible"]) ? $_POST["is_visible"] : "";
            $post_submit = isset($_POST["submit"]) ? $_POST["submit"] : "";
        }

        switch ($get_action) {
            case "add":
                if ((!$post_categorie) || (!$post_description) || (!$post_is_visible)) {
                    if ($post_submit) {
                        if (!$$post_categorie) {
                            $msg .= "<p class='red'>&rarr; categorie obligatoire</p>";
                        }
                        if (!$post_description) {
                            $msg .= "<p class='red'>&rarr; decription obligatoire</p>";
                        }
                        if (!$post_is_visible) {
                            $msg .= "<p class='red'>&rarr; is_visible obligatoire</p>";
                        }
                    }
                    $page = "admin_categories_add";
                } else {

                    $insert = insertCategories($post_categorie, $post_description, $post_is_visible);
                    if ($insert) {
                        $msg .= "<p><b>&rarr; Insertion effectuée avec succès.</b></p>\n";
                    } else {
                        $msg .= "<p><b>&rarr; Oupsss... problème lors de l'insertion....</b></p>\n";
                    }
                    $result = getCategories(0);
                    $page = "admin_categories_view";
                }

                break;

            case "update":
                if ((!$post_categorie) || (!$post_description) || (!$post_is_visible)) {
                    if (!$post_submit) {
                        $result = getCategories($get_id);
                    } else {

                        if (!$post_categorie) {
                            $msg .= "<p class='red'>&rarr; categorie obligatoire</p>";
                        }
                        if (!$post_description) {
                            $msg .= "<p class='red'>&rarr; decription obligatoire</p>";
                        }
                        if (!$post_is_visible) {
                            $msg .= "<p class='red'>&rarr; is_visible obligatoire</p>";
                        }
                    }
                    $page = "admin_categories_update";
                } else {

                    $update = updateCategories($post_categorie, $post_description, $post_is_visible);
                    if ($update) {
                        $msg .= "<p><b>&rarr; Insertion effectuée avec succès.</b></p>\n";
                    } else {
                        $msg .= "<p><b>&rarr; Oupsss... problème lors de l'insertion....</b></p>\n";
                    }
                    $result = getCategories(0);
                    $page = "admin_categories_view";
                }

                break;
            case "desactive":
                $desactive = desactiveCategories($get_id);

                if ($desactive) {
                    $msg .= "<p><b>&rarr; Désactivation effectuée avec succès.</b></p>\n";
                } else {
                    $msg .= "<p><b>&rarr; Oupsss... problème lors de la désactivation....</b></p>\n";
                }

                $result = getCategories(0);
                $page = "admin_categories_view";

                break;

            case "active":
                $active = activeCategories($get_id);

                if ($active) {
                    $msg .= "<p><b>&rarr; Activation effectuée avec succès.</b></p>\n";
                } else {
                    $msg .= "<p><b>&rarr; Oupsss... problème lors de l'activation....</b></p>\n";
                }

                $result = getCategories(0);
                $page = "admin_categories_view";

                break;

            case "delete":
                $delete = deleteCategories($get_id);

                if ($delete) {
                    $msg .= "<p><b>&rarr; Suppression effectuée avec succès.</b></p>\n";
                } else {
                    $msg .= "<p><b>&rarr; Oupsss... problème lors de la suppression....</b></p>\n";
                }

                $result = getCategories(0);
                $page = "admin_categories_view";
                break;

            default:
                $result = getCategories(0);
                $page = "admin_categories_view";
                break;
        }
    }

}
