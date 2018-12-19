{extends file='layouts/converter.layout.tpl'}
{block name='content'} 
  <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{$lang->line('converters')}</h1>
        <ol class="breadcrumb material-breadcrumb">
            <li class="material-breadcrumb__item"><a href="/" class="material-breadcrumb__link">Главная</a></li>
            <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">
                <a href="{$base_url}converter/">
                  <i class="glyphicon glyphicon-transfer fa-fw"></i>
                {$lang->line('converters')}</span>
                </a>
              </li>
            <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">
                <i class="glyphicon glyphicon-transfer fa-fw"></i>
                {$converter->title}</span></li>
        </ol>
    </div>
</div>

<script>
  var converter_id = {$converter->id};
</script>

<div class="row">
    <div class="col-lg-12  animated fadeInUp" id="converter_main_info"></div>
</div>

<div class="row">
    <div class="col-lg-12  animated fadeInUp" id="converter_list_devices"></div>
</div>

<script type="text/template" id="converter_main_info_tpl">
    {include file="converter/helpers/main_info.tpl"}
</script>

<script type="text/template" id="converter_modal_edit_tpl">
    {include file="converter/helpers/modal_edit.tpl"}
</script>

<script type="text/template" id="meter_modeal_edit_tpl">
    {include file="meter/helpers/modal_edit.tpl"}
</script>

<script type="text/template" id="converter_list_devices_tpl">
    {include file="converter/helpers/list_devices.tpl"}
</script>


<script src="{$base_url}ts/models/converter.js"></script>
<script src="{$base_url}ts/models/convertertype.js"></script>
<script src="{$base_url}ts/models/meter.js"></script>
<script src="{$base_url}ts/models/meter_type.js"></script>
<script src="{$base_url}ts/collections/converter.js"></script>
<script src="{$base_url}ts/collections/convertertypes.js"></script>
<script src="{$base_url}ts/collections/meters.js"></script>
<script src="{$base_url}ts/collections/meter_types.js"></script>
<script src="{$base_url}ts/views/converter/modal_edit.js"></script>
<script src="{$base_url}ts/views/converter/helpers/main_info.js"></script>
<script src="{$base_url}ts/views/converter/helpers/list_devices.js"></script>
<script src="{$base_url}ts/views/meter/helpers/modal_edit.js"></script>
<script src="{$base_url}ts/views/converter/converter.js"></script>

{/block}