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
    $objResponse->addAssign('CurrentModule', 'value', $moduleName );

    $objResponse->addScriptCall( 'removeAllOptions', 'ModuleFunction' );

    foreach( $functionNames as $functionName )
    {
        $objResponse->addScriptCall( 'addOption', 'ModuleFunction', $functionName, $functionName );
    }

    if ( count( $functionNames ) > 0 )
    {
        $objResponse->addAssign( 'AddFunction', 'disabled', false );
        $objResponse->addAssign( 'AddFunction', 'className', 'button' );

        $objResponse->addAssign( 'Limitation', 'disabled', false );
        $objResponse->addAssign( 'Limitation', 'className', 'button' );
    }
    else
    {
        $objResponse->addAssign( 'AddFunction', 'disabled', true );
        $objResponse->addAssign( 'AddFunction', 'className', 'button-disabled' );

        $objResponse->addAssign( 'Limitation', 'disabled', true );
        $objResponse->addAssign( 'Limitation', 'className', 'button-disabled' );
    }

    return $objResponse->getXML();
}

?>