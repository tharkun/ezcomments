<?php
/**
 * File containing logic of validatecomments view
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPLv2
 *
 */

$Module = $Params['Module'];
$http = eZHTTPTool::instance();

if ( $http->hasPostVariable( 'ConfirmButton' ) )
{
    $validateIDArray = $http->hasSessionVariable( 'ValidateCommentsIDArray' ) ? $http->sessionVariable( 'ValidateCommentsIDArray' ) : array();

    if ( is_array( $validateIDArray ) && !empty( $validateIDArray ) )
    {
        $db = eZDB::instance();
        $db->begin();
        $commentManager = ezcomCommentManager::instance();

        foreach ( $validateIDArray as $validateID )
        {
            $commentToValidate = ezcomComment::fetch( $validateID );
            $validateResult = $commentManager->validateComment( $commentToValidate );
            if ( $validateResult === true )
            {
                eZContentCacheManager::clearContentCacheIfNeeded( $commentToValidate->attribute( 'contentobject_id' ) );
            }
        }

        $db->commit();
    }

    $Module->redirectTo( '/comment/list/(status)/0' );
}
if ( $http->hasPostVariable( 'CancelButton' ) )
{
    $Module->redirectTo( '/comment/list/' );
}

$contentInfoArray = array();

$tpl = eZTemplate::factory();

$tpl->setVariable( 'persistent_variable', false );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:comment/validatecomments.tpl' );
$Result['path'] = array( array( 'text' => ezpI18n::tr( 'ezcomments/comment/validatecomments', 'Validate comments' ),
    'url' => false ) );

$contentInfoArray['persistent_variable'] = false;
if ( $tpl->variable( 'persistent_variable' ) !== false )
    $contentInfoArray['persistent_variable'] = $tpl->variable( 'persistent_variable' );

$Result['content_info'] = $contentInfoArray;

?>