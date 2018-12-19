<div class="panel panel-default">
    <div class="panel-heading">
        Описание
        <span class="fa fa-pencil pull-right"></span>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
              
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th>Название</th>
                <th>Серийный номер</th>
                <th>Тип</th>
                <th>Статус</th>
              </tr>
            </thead>

            <tbody>

              <% _.each( devices , function( device ){ %>
            <tr>
              <td></td>
              <td></td>
              <td><%= device.get('title') %></td>
              <td><%= device.get('num_serial') %></td>
              <td><%= device.get('num_serial') %></td>
              <td><%= device.get('status') %></td>
            </tr>
              <% }) %>



            </tbody> 
            <tfoot>
              <tr>
                <td colspan="100">
                  <button style="width:100%;" class="btn btn-default fa fa-plus-circle"
                  id="add_device"
                  ></button>
                </td>
              </tr>
            </tfoot>

        </table>
</div>
</div>