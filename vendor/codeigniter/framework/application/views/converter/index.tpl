{extends file='layouts/converter.layout.tpl'}
{block name='content'} 

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{$lang->line('converters')}</h1>
        <ol class="breadcrumb material-breadcrumb">
            <li class="material-breadcrumb__item"><a href="/" class="material-breadcrumb__link">Главная</a></li>
            <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">
                <i class="glyphicon glyphicon-transfer fa-fw"></i>
                {$lang->line('converters')}</span></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12  animated fadeInUp" id="converter_list"></div>
</div>

<script type="text/template" id="converter_list_tpl">
    {include file="converter/helpers/list.tpl"}
</script>

<script type="text/template" id="converter_modal_edit_tpl">
    {include file="converter/helpers/modal_edit.tpl"}
</script>

<script type="text/template" id="converter_modal_delete_tpl" >
    {include file="converter/helpers/modal_delete.tpl"}
</script>  

<script src="{$base_url}ts/models/converter.js"></script>
<script src="{$base_url}ts/models/convertertype.js"></script>
<script src="{$base_url}ts/collections/converter.js"></script>
<script src="{$base_url}ts/collections/convertertypes.js"></script>
<script src="{$base_url}ts/views/converter/list.js"></script>
<script src="{$base_url}ts/views/converter/modal_edit.js"></script>
<script src="{$base_url}ts/views/converter/modal_delete.js"></script>
<script src="{$base_url}ts/views/converter/index.js"></script>


{/block} 



