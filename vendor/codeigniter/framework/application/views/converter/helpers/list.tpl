<div class="panel panel-default">
    <div class="panel-heading">
        {$lang->line('converters')}
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="sortable" data-sort="about">{$lang->line('converter_table_title')}</th>
                    <th class="sortable" data-sort="type">{$lang->line('converter_table_type')}</th>
                    <th class="sortable" data-sort="ip">{$lang->line('converter_table_ip')}</th>
                    <th class=" sortable" data-sort="port">{$lang->line('converter_table_port')}</th>
                    <th colspan="3">{$lang->line('converter_table_metering_devices')}</th>
                </tr>
            </thead>
            <tbody>
              <% _.each(collection, function(converter){ %>
              <tr id="<%= converter.cid %>">

                <% if( converter_types.length ){ %>

                    <% if (converter.get('count_child_meters') >= 1 ) { %>
                    <td class="action" style="cursor:not-allowed;">
                        <span class="fa fa-times " style="cursor:not-allowed;color:#bfbfbf;" title="Вы не можете удалить, пока есть дочерние элементы"></span>
                    </td>
                    <% }else{ %>
                    <td class="action converter_delete_item" >
                        <a href="#"><i class="fa fa-times" alt="delete" ></i></a>
                    </td>
                    <% } %>

                <% } %>

                <td class="action converter_edit_item" >
                    <a href="#"><i class="fa fa-pencil " alt="edit"></i></a>
                </td>
                <td>
                    <i class="<%= converter.get_status_class() %> glyphicon glyphicon-transfer"></i>
                    <a href="{$base_url}converter/<%= converter.get('id') %>"><%= converter.escape('title') %></a>
                </td>
                <% 
                converter_type = converter_types.findWhere({ id : converter.get('type') })
                if( typeof converter_type == "undefined" ){
                    converter_type = new CONVERTER_TYPE_MODEL
                } %>

                <td><%= converter_type.get('title') %></td>
                <td><%= converter.get('ip') %></td>
                <td><%= converter.get('port') %></td>
                <td><i class="fa fa-flash"></i> <%= converter.get('count_child_meters') %></td>
                <td><i class="fa fa-flash text-danger"></i> <%= converter.get('count_excluded_meters') %></td>
                <td><i class="fa fa-flash text-muted"></i> <%= converter.get('count_not_ok_meters') %></td>
            </tr>
            <% }) %>
        </tbody> 
        <tfoot>
            <tr>
                <th colspan="100" class="text-center" id="converter_add_item">
                    <button style="width:100%;" class="btn btn-default fa fa-plus-circle"></button>
                </th>
            </tr>
        </tfoot>
    </table>
    <div class="children_pagination"></div>
</div>
</div>