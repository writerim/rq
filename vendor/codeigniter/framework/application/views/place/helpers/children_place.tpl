<div class="panel panel-default">
  <div class="panel-heading">Дочерние элементы</div>
  <div class="panel-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="place_children_container">
      <div class="table-responsive" id="place_children_table">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="action"></th>
              <th class="action"></th>
              <th>{$lang->line('place_table_title')}</th>
              <th>{$lang->line('place_table_child_items')}</th>
              <th colspan="3">{$lang->line('place_table_metering_devices')}</th>
            </tr>
          </thead>                    
          <tbody>     
            <% _.each( children_places.toArray(), function( place_item ){ %>
            <tr id="<%= place_item.cid %>" >
              <% if ( place_item.get('places_all') == 0 && place_item.get('meters_all') == 0 ) { %>
              <td class="action children_delete" >
                <a href="#" class="fa fa-times children_delete" alt="delete"></a>
              </td>
              <% } else { %>
              <td class="action">
                <span class="text-muted fa fa-times"></span>
              </td>
              <% } %>
              <td class="action children_edit" >
                <a href="#" class="fa fa-pencil" alt="edit"></a>
              </td>
              <td>
                <a href="{$base_url}place/<%= place_item.get('id') %>" class="link_to_place">
                  <% if( place_item.get('type') == 5 ){ %>
                  <i class="fa-building-o fa"></i> 
                  <% }else if( place_item.get('type') == 2 ){ %>
                  <i class="glyphicon glyphicon-home"></i> 
                  <% }else if( place_item.get('type') == 1 ){ %>
                  <i class="fa-road fa"></i> 
                  <% }else{ %>
                  <i class="fa-cube fa"></i> 
                  <% } %>
                  <span><%= place_item.escape('title') %></span>
                </a>
              </td>
              <td>
                <i class="fa fa-map-marker"></i> 
                <span class="counter_places"><%= place_item.get('places_all') %></span>
                <td title="{$lang->line('number_of_devices')}" class="short_add_meter_to_place">
                  <i class="fa fa-flash"></i> 
                  <span class="counter_meters"><%= place_item.get('meters_all') %></span>
                </td>
                <td title="{$lang->line('devices_with_errors')}">
                  <i class="text-danger fa fa-flash"></i> 
                  <span><%= place_item.get('meters_error') %></span>
                </td>
                <td title="{$lang->line('excluded_devices')}">
                  <i class="text-muted fa fa-flash"></i> 
                  <span><%= place_item.get('meters_excluded') %></span>
                </td>
              </tr>
              <% }) %>
            </tbody>
            <tfoot>
              <tr>
                <td id="add_child" colspan="10">
                  <button style="width:100%;" class="btn btn-default fa fa-plus-circle"></button>
                  <!-- <a href="#" class="fa fa-plus-circle "></a> -->
                </td>
              </tr>
            </tfoot>
          </table>
          <div class="children_pagination"></div>
        </div>
      </div>
    </div>
  </div>
</div>
