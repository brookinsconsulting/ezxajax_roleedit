function removeAllOptions( selectid )
{
    var i;
    var select;

    select = document.getElementById( selectid );

    if ( select )
    {
        for ( i = ( select.length - 1 ); i >= 0; i-- )
        {
            select.options[i] = null;
        }
    }
}

function addOption( selectid, value, text )
{
    var select = document.getElementById( selectid );

    if(select)
    {
        select.options[select.options.length] = new Option( text, value, false, false );
    }
}