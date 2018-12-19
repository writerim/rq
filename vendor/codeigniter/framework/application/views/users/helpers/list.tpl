<div class="panel panel-default">
  <div class="panel-heading">{$lang->line('users')}</div>
  <div class="panel-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="place_children_container">
      <div class="table-responsive" id="place_children_table">
        <table class="table table-striped">
          <thead>
          </thead>

            <tbody>
                
              <% _.each( users.toArray() , function( user ){ %>
                <tr>
                  <td>
                    <%= user.get('login') %>
                  </td>
                </tr>
              <% }) %>

            </tbody>

            <tfoot>
             </tfoot>
          </table>
          <div class="children_pagination"></div>
        </div>
      </div>
    </div>
  </div>
</div>
