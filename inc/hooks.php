<?php
/**
 * Overwrite default WordPress functions.
 *
 * @package ArmandPhilippot-com
 * @since   0.0.1
 * @since   1.2.0 Split hooks functions in separated files in hooks folder.
 */

/**
 * Require all hooks in hooks folder.
 */
require_once 'hooks/acf.php';
require_once 'hooks/archives.php';
require_once 'hooks/body.php';
require_once 'hooks/comments.php';
require_once 'hooks/cpt.php';
require_once 'hooks/editor.php';
require_once 'hooks/more-link.php';
require_once 'hooks/nav.php';
require_once 'hooks/pagination.php';
require_once 'hooks/posts.php';
require_once 'hooks/scripts.php';
