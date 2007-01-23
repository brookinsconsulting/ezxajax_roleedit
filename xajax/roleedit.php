<?php

function moduleFunctions( $moduleName )
{
    include_once( 'lib/ezutils/classes/ezmodule.php' );
    $mod = & eZModule::exists( $moduleName );

    if ( $mod )
    {
        $functions =& $mod->attribute( 'available_functions' );
        $functionNames = array_keys( $functions );
        sort( $functionNames );
    }
    else
    {
        $functionNames = array();
    }

    $objResponse = new xajaxResponse();

    // set value of hidden input field so we can go straight trough all wizard steps
    $objResponse->assign('CurrentModule', 'value', $moduleName );

    $objResponse->call( 'removeAllOptions', 'ModuleFunction' );

    foreach( $functionNames as $functionName )
    {
        $objResponse->call( 'addOption', 'ModuleFunction', $functionName, $functionName );
    }

    if ( count( $functionNames ) > 0 )
    {
        $objResponse->assign( 'AddFunction', 'disabled', false );
        $objResponse->assign( 'AddFunction', 'className', 'button' );

        $objResponse->assign( 'Limitation', 'disabled', false );
        $objResponse->assign( 'Limitation', 'className', 'button' );
    }
    else
    {
        $objResponse->assign( 'AddFunction', 'disabled', true );
        $objResponse->assign( 'AddFunction', 'className', 'button-disabled' );

        $objResponse->assign( 'Limitation', 'disabled', true );
        $objResponse->assign( 'Limitation', 'className', 'button-disabled' );
    }

    return $objResponse;
}

?>