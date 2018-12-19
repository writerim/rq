<div class="panel panel-default">
    <div class="panel-heading">
        {$lang->line('rules')}
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <td></td>
                  <td></td>
                  <td>Название</td>
                </tr>
            </thead>
            <tbody>
              <% _.each(rules.toArray(), function(rule){ %>
              <tr id="<%= rule.cid %>">
                <td class="action rule_delete_item">
                    <a href="#"><i class="fa fa-times" alt="delete"></i></a>
                </td>
                <td class="action rule_edit_item" >
                    <a href="#"><i class="fa fa-pencil " alt="edit"></i></a>
                </td>
                <td><%= rule.get('title') %></td>
            </tr>
            <% }) %>
        </tbody> 
        <tfoot>
            <tr>
                <th colspan="100" class="text-center" id="add_rule">
                    <button style="width:100%;" class="btn btn-default fa fa-plus-circle"></button>
                </th>
            </tr>
        </tfoot>
    </table>
    <div class="children_pagination"></div>
</div>
</div>