<?php
/**
 * File containing logic of list view
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPLv2
 *
 */

$Module = $Params['Module'];

$http = eZHTTPTool::instance();
if ( $http->hasPostVariable( 'RemoveCommentsButton' ) )
{
    if ( $http->hasPostVariable( 'DeleteIDArray' ) )
    {
        $deleteIDArray = $http->postVariable( 'DeleteIDArray' );
        if ( $deleteIDArray !== null )
        {
            $http->setSessionVariable( 'DeleteCommentsIDArray', $deleteIDArray );
            $Module->redirectTo( $Module->functionURI( 'removecomments' ) . '/' );
        }
    }
}


if ( $http->hasPostVariable( 'ValidateCommentsButton' ) )
{
    if ( $http->hasPostVariable( 'DeleteIDArray' ) )
    {
        $deleteIDArray = $http->postVariable( 'DeleteIDArray' );
        if ( $deleteIDArray !== null )
        {
            $http->setSessionVariable( 'ValidateCommentsIDArray', $deleteIDArray );
            $Module->redirectTo( $Module->functionURI( 'validatecomments' ) . '/' );
        }
    }
}

$contentInfoArray = array();

$tpl = eZTemplate::factory();

$tpl->setVariable( 'persistent_variable', false);

if ( isset( $Params['UserParameters'] ) )
{
    $UserParameters = $Params['UserParameters'];
}
else
{
    $UserParameters = array();
}
if ( isset( $Params['Offset'] ) ) $offset = (int) $Params['Offset'];
$viewParameters = array( 'offset' => $offset );
$viewParameters = array_merge( $viewParameters, $UserParameters );
$tpl->setVariable( 'view_parameters', $viewParameters );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:comment/list.tpl' );
$Result['path'] = array( array( 'text' => ezpI18n::tr( 'ezcomments/comment/list', 'Comments list' ),
                                'url' => false ) );

$contentInfoArray['persistent_variable'] = false;
if ( $tpl->variable( 'persistent_variable' ) !== false )
    $contentInfoArray['persistent_variable'] = $tpl->variable( 'persistent_variable' );

$Result['content_info'] = $contentInfoArray;

?>