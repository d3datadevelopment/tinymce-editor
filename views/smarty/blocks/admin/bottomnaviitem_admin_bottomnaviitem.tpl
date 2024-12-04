[{$smarty.block.parent}]

[{if method_exists($oViewConf,'getTinyMceIncludes') }]
    [{foreach from=$oViewConf->getTinyMceIncludes() item="tmceinclude"}]
        [{oxscript include=$tmceinclude}]
    [{/foreach}]
[{/if}]

[{if method_exists($oViewConf,'getTinyMceScripts') }]
    [{foreach from=$oViewConf->getTinyMceScripts() item="tmcescript"}]
        [{oxscript add=$tmcescript}]
    [{/foreach}]
[{/if}]

[{if method_exists($oViewConf,'getTinyMceInitCode') }]
    [{ $oViewConf->getTinyMceInitCode() }]
[{/if}]